<?php

namespace App\Http\Controllers;

use App\Biz\Newway\Template\CpmsTemplate;
use App\TemplateDocument;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\TemplateProcessor;
use PDF;

class UserController extends Controller
{
    protected $cpmsTemplate;

    public function __construct(
        CpmsTemplate $cpmsTemplate
    )
    {
        $this->cpmsTemplate = $cpmsTemplate;
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function wordExport($id)
    {
        $user = User::findOrFail($id);
        $templateProcessor = new TemplateProcessor('word-template/user.docx');
        $templateProcessor->setValue('id', $user->id);
        $templateProcessor->setValue('name', $user->name);
        $templateProcessor->setValue('email', $user->email);
        $templateProcessor->setValue('address', $user->address);
        $templateProcessor->setValue('ca', Carbon::today());
        $templateProcessor->setValue('d', $user->created_at->format('d'));
        $templateProcessor->setValue('m', $user->created_at->format('m'));
        $templateProcessor->setValue('Y', $user->created_at->format('Y'));
        $fileName = $user->name;
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }

    public function wordExportHtml($id)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection(); // là method của phpWord dùng để thêm mới 1 thành phần word, mỗi phần sẽ có các thuộc tính khác nhau, như kích thước trang,
        // hướng trang, lề trang, tiêu đề, chân trang ,...có thể chứa hình ảnh, bảng biểu
        $template = TemplateDocument::select('id','view')->where('id',1)->first();
        $view = $template->view;
        // replace
        $view = str_replace("<br>","<br/>",$view);
        $view = str_replace('<div id="data"></div>',"{{#data}}",$view); // cấu trúc mustache tên biến phải là dạng {{tenbien}}. Nếu key data => array(...) (vd đang ở trạng thái này)
        // thì {{#data}} hoặc nếu mảng gồm n mảng thì {{#array}} {{/array}}
        $view = str_replace('<div class="data"></div>',"{{/data}}",$view);
//        $view = str_replace('<tr id="item"></tr>',"{{#item}}",$view);
//        $view = str_replace('<tr class="item"></tr>',"{{/item}}",$view); //  nếu có foreach data thì day la item => array(...)
        // end replace
        /**
         * Gọi đến hàm lấy ra dữ liệu chuẩn dạng mustache là dạng set value như hàm wordExport
         */
        $request = null;
        $data = $this->getDataMustache($request,$id); // Dùng lấy mảng data chuyển đỏi key ${key} trong word có value
        /**
         * Gọi đến hàm mustache trả về view
         */

        $viewResult =  $this->cpmsTemplate->convertMustache($view, $data); // Lấy data xong thì hiển thị dữ liệu vào đoạn html ( đây là đoạn html chứa dữ liệu đã cho vào )
        Html::addHtml($section, $viewResult); // Là method của HTML, dùng để thêm đoạn html $viewResult vừa converMustache cho vào 1 phần của tài liệu word

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007'); // mã của PHP, khởi tạo đối tượng ghi cho tài liệu word. $phpWord = new phpWord,
        //Có năm loại tệp Word được hỗ trợ: ‘ODText’, ‘RTF’, ‘Word2007’, ‘HTML’ và ‘PDF’
            $cacheDir = public_path('word-template/'); // trỏ tới thư mục word-template trong folder public

        $objWriter->save($cacheDir . 'registration_card.docx');  // Lưu tệp vào đường dẫn mong muốn
            return response()->download(public_path('word-template/registration_card.docx')) // tải tệp xuống
                ->deleteFileAfterSend(true);
    }

    public function getDataMustache($request, $id)
    {
        $user = User::findOrFail($id);
        $data = $this->convertToSetValue($user);
        return $data;
    }

    #Chuyển đổi dữ liệu sang dạng setValue như hàm wordExport
    public function convertToSetValue($data){
        $dataHtml = array(
            'data' => array("HotelLogo" => 'https://upload.wikimedia.org/wikipedia/vi/thumb/6/65/VNPT_Logo.svg/640px-VNPT_Logo.svg.png',
                "HotelName" => 'Khách sạn newway',
                "HotelAddress" => $data->address,
                "HotelTel" => '0123456789',
                "HotelWeb" => 'newway.com',
                "ReservationCode" => '123456',
                "GuestName" => $data->name,
                "GuestGender" => 'Nam',
                "GuestBirthday" => '10-10-2000',
                "FolioCode" => 'FOLIO123',
                "RoomNight" => 'RoomNight',
                "RoomNumber" => '18A01',
                'Adult'=> '3 Ng lớn',
                'Child' => '2 trẻ con',
                "ArrivalDate" => Carbon::now()->format('d-m-Y'),
                "DepartureDate" => Carbon::now()->addDay(10)->format('d-m-Y'),
                "CheckInTime" => Carbon::now()->format('H:i'),
                "CheckOutTime" =>  Carbon::now()->addDay(2)->format('H:i'),)
        );
        return $dataHtml;
    }

    // Đoạn html dạng foreach mảng users
    public function wordExportHtmlForUser($id)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection(); // là method của phpWord dùng để thêm mới 1 thành phần word, mỗi phần sẽ có các thuộc tính khác nhau, như kích thước trang,
        // hướng trang, lề trang, tiêu đề, chân trang ,...có thể chứa hình ảnh, bảng biểu
        $template = TemplateDocument::select('id','view')->where('id',2)->first();
        $view = $template->view;
        // replace
//        $view = str_replace('<tr id="item"></tr>',"{{#item}}",$view);
//        $view = str_replace('<tr class="item"></tr>',"{{/item}}",$view); //  nếu có foreach data thì day la item => array(...)
        // end replace
        /**
         * Gọi đến hàm lấy ra dữ liệu chuẩn dạng mustache là dạng set value như hàm wordExport
         */
        $request = null;
        $data['data'] = User::all()->toArray(); // Dùng lấy mảng data chuyển đỏi key ${key} trong word có value
        /**
         * Gọi đến hàm mustache trả về view
         */

        $viewResult =  $this->cpmsTemplate->convertMustache($view, $data); // Lấy data xong thì hiển thị dữ liệu vào đoạn html ( đây là đoạn html chứa dữ liệu đã cho vào )
        Html::addHtml($section, $viewResult); // Là method của HTML, dùng để thêm đoạn html $viewResult vừa converMustache cho vào 1 phần của tài liệu word

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007'); // mã của PHP, khởi tạo đối tượng ghi cho tài liệu word. $phpWord = new phpWord,
        //Có năm loại tệp Word được hỗ trợ: ‘ODText’, ‘RTF’, ‘Word2007’, ‘HTML’ và ‘PDF’
        $cacheDir = public_path('word-template/'); // trỏ tới thư mục word-template trong folder public

        $objWriter->save($cacheDir . 'users.docx');  // Lưu tệp vào đường dẫn mong muốn
        return response()->download(public_path('word-template/users.docx')) // tải tệp xuống
        ->deleteFileAfterSend(true);
    }

    /**
     * Dùng package phpWord kết hợp package domPdf để convert file .doc sang dạng pdf
     * Cách này sẽ giữ định dạng và nội dung của file word. (TH code dưới vẫn đang bị lỗi kiểu chữ, cần phải thêm font chữ mới và chaset utf-8 nhưng chư có cách
     * Chỉ dùng domPdf có thể sẽ không hiển thị được chính xác thành phần html, css, font chữ, ảnh hay bảng biểu.
     */
    public function wordExportPdfForUser($id)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection(); // là method của phpWord dùng để thêm mới 1 thành phần word, mỗi phần sẽ có các thuộc tính khác nhau, như kích thước trang,
        // hướng trang, lề trang, tiêu đề, chân trang ,...có thể chứa hình ảnh, bảng biểu
        $template = TemplateDocument::select('id','view')->where('id',2)->first();
        $view = $template->view;
        // replace
//        $view = str_replace('<tr id="item"></tr>',"{{#item}}",$view);
//        $view = str_replace('<tr class="item"></tr>',"{{/item}}",$view); //  nếu có foreach data thì day la item => array(...)
        // end replace
        /**
         * Gọi đến hàm lấy ra dữ liệu chuẩn dạng mustache là dạng set value như hàm wordExport
         */
        $request = null;
        $data['data'] = User::all()->toArray(); // Dùng lấy mảng data chuyển đỏi key ${key} trong word có value
        /**
         *  Đã convert thành công từ file .doc có sẵn trong public sang file pdf
         */
        //
//        $domPdfPath = base_path('vendor/dompdf/dompdf');
//        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
//        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
//        $Content = \PhpOffice\PhpWord\IOFactory::load(public_path('word-template/users.docx'));
//        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'PDF');
//        $PDFWriter->save(public_path('doc-pdf.pdf'));
//        return response()->download(public_path('doc-pdf.pdf')) // tải tệp xuống
//        ->deleteFileAfterSend(true);
        /**
         * Dùng html đã sử dụng mustache để convert từ word sang pdf
         */
        $viewResult =  $this->cpmsTemplate->convertMustache($view, $data); // Lấy data xong thì hiển thị dữ liệu vào đoạn html ( đây là đoạn html chứa dữ liệu đã cho vào )
        Html::addHtml($section, $viewResult); // Là method của HTML, dùng để thêm đoạn html $viewResult vừa converMustache cho vào 1 phần của tài liệu word

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007'); // mã của PHP, khởi tạo đối tượng ghi cho tài liệu word. $phpWord = new phpWord,
        //Có năm loại tệp Word được hỗ trợ: ‘ODText’, ‘RTF’, ‘Word2007’, ‘HTML’ và ‘PDF’
        $cacheDir = public_path('word-template/'); // trỏ tới thư mục word-template trong folder public
        $objWriter->save($cacheDir . 'users.docx');  // Lưu tệp vào đường dẫn mong muốn

        //xuất pdf
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        $Content = \PhpOffice\PhpWord\IOFactory::load(public_path('word-template/users.docx'));
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'PDF');
        $PDFWriter->save(public_path('word-template/users.pdf'));
        // Xoá cả file .doc
        if(file_exists($cacheDir.'/users.docx')) {
            unlink($cacheDir.'/users.docx');
        }
        return response()->download(public_path('word-template/users.pdf')) // tải tệp xuống
        ->deleteFileAfterSend(true);
    }

    /**
     * chỉ dùng 1 package domPdf
     */
    public function wordExportPdfForUser2($id)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection(); // là method của phpWord dùng để thêm mới 1 thành phần word, mỗi phần sẽ có các thuộc tính khác nhau, như kích thước trang,
        // hướng trang, lề trang, tiêu đề, chân trang ,...có thể chứa hình ảnh, bảng biểu
        $template = TemplateDocument::select('id','view')->where('id',2)->first();
        $view = $template->view;
        // replace
//        $view = str_replace('<tr id="item"></tr>',"{{#item}}",$view);
//        $view = str_replace('<tr class="item"></tr>',"{{/item}}",$view); //  nếu có foreach data thì day la item => array(...)
        // end replace
        /**
         * Gọi đến hàm lấy ra dữ liệu chuẩn dạng mustache là dạng set value như hàm wordExport
         */
        $request = null;
        $data['data'] = User::all()->toArray(); // Dùng lấy mảng data chuyển đỏi key ${key} trong word có value

        /**
         * Dùng html đã sử dụng mustache để convert từ word sang pdf
         */
        $viewResult =  $this->cpmsTemplate->convertMustache($view, $data); // Lấy data xong thì hiển thị dữ liệu vào đoạn html ( đây là đoạn html chứa dữ liệu đã cho vào )

        $view = '<!doctype html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
        $view .= '<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">';
        $view .= "<style>
            body{
                font-family: 'Roboto', sans-serif;}
        </style>";
        $view .= '</head><body>';
        $view .= $viewResult;
        $view .= '</body></html>';
        $pdf = PDF::loadHTML($view, 'UTF-8');
//        return $pdf->stream();
        return $pdf->download('users.pdf');
//        return response()->download(public_path('word-template/users.pdf')) // tải tệp xuống
//        ->deleteFileAfterSend(true);
    }

}
