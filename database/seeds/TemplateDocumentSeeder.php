<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $view1 = '<div id="data"></div>
<div class="header" style="margin-top: 50px;display: flex; gap: 25px;">
    <table style="width: 100%;border-spacing: 0px;">
        <tr>
            <td class="header__logo" style="width: 14%; border: none">
                {{HotelLogo}}
            </td>
            <td class="header__info" style="border: none; padding-left: 25px; font-size:12px; vertical-align: top;">
                <span class="header__info__name" style="font-weight: bold;text-transform: uppercase;margin-bottom: 2px;">{{HotelName}}</span><br/>
                <span class="header__info__location" style="margin-bottom: 2px">Địa chỉ: {{HotelAddress}}</span><br/>
                <span class="header__info__phone" style="margin-bottom: 2px">Điện thoại: {{HotelTel}}</span><br/>
                <span class="header__info__web" style="margin-bottom: 2px">Website: {{HotelWeb}}</span>
            </td>
        </tr>
    </table>
</div>
<div class="title" style="text-align: center;margin-top: 10px;text-transform: uppercase;font-size: 20px; font-weight: bold; width:100%; display:flex; justify-content: center;">
    REGISTRATION CARD
</div>
<div class="table--wrap">
    <div class="booking__code" style="text-align: right;margin-top: 10px;margin-bottom: 10px;padding-right: 50px; font-size:12px;">
        <p style="margin-right: 5px;">Booking Code:<span style="font-weight: bold;"> {{ReservationCode}}</span></p>
    </div>
    <div class="table">
        <table style="width: 100%;border-spacing: 0px; font-size:12px">
            <tbody>
            <tr class="table__tr--info" style=" text-transform: uppercase;font-weight: bold;background-color: #d3d3d3;">
                <td colspan="4" style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);">INFORMATION DETAILS</td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199); width:50%">Guest name: <span style="font-weight: bold;text-transform: uppercase;">{{GuestGender}}{{GuestName}}</span></td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">Date of birth: <span style="font-weight: bold;text-transform: uppercase;">{{GuestBirthday}}</span></td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">Folio: <span style="font-weight: bold;text-transform: uppercase;">{{FolioCode}}</span></td>
            </tr>
            <tr>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">Arrival date: <span style="font-weight: bold;text-transform: uppercase;">{{ArrivalDate}}</span></td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">Departure Date: <span style="font-weight: bold;text-transform: uppercase;">{{DepartureDate}}</span></td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">Night: <span style="font-weight: bold;text-transform: uppercase;">{{RoomNight}}</span></td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">Room: <span style="font-weight: bold;text-transform: uppercase;">{{RoomNumber}}</span></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:50%">TA/Company: <span style="font-weight: bold;text-transform: uppercase;">{{SourceName}}</span></td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">Email: <span style="font-weight: bold;text-transform: uppercase;">{{GuestEmail}}</span></td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">Room type: <span style="font-weight: bold;text-transform: uppercase;">{{RoomType}}</span></td>
            </tr>
            <tr>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">Adult/Child: <span style="font-weight: bold;text-transform: uppercase;">{{Adult}}/{{Child}}</span></td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">Nationality: <span style="font-weight: bold;text-transform: uppercase;">{{GuestNationality

}}</span></td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">Mobile: <span style="font-weight: bold;text-transform: uppercase;">{{GuestPhone}}</span></td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">Room rate: <span style="font-weight: bold;text-transform: uppercase;">{{RoomRate}} {{CurrencyType}}</span></td>
            </tr>
            <tr>
                <td colspan="4" style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);">Notes:<span style="font-weight: bold;text-transform: uppercase;">{{RoomNote}}</span></td>
            </tr>
            <tr class="table__tr--info" style=" text-transform: uppercase;font-weight: bold;background-color: #d3d3d3;">
                <td colspan="4" style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);">PAYMENT METHOD</td>
            </tr>
            <tr class="table__tr--payment">
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">
                    <input type="checkbox" {{cash}}/><p><span style="font-weight: 600;text-transform: uppercase;text-transform: capitalize;font-weight: normal;">Cash</span></p></td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">
                    <input type="checkbox" {{bank_transfer}}/><p><span style="font-weight: 600;text-transform: uppercase;text-transform: capitalize;font-weight: normal;">Bank transfer</span></p></td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">
                    <input type="checkbox" {{visa_card}}/><p><span style="font-weight: 600;text-transform: uppercase;text-transform: capitalize;font-weight: normal;">Visa card</span></p></td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">
                    <input type="checkbox" {{master_card}}/><p><span style="font-weight: 600;text-transform: uppercase;text-transform: capitalize;font-weight: normal;">Master card</span></p> </td>
            </tr>
            <tr class="table__tr--payment">
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">

                    <input type="checkbox" {{amex}}/><p><span style="font-weight: 600;text-transform: uppercase;text-transform: capitalize;font-weight: normal;">Amex</span></p>
                </td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">

                    <input type="checkbox" {{jcb}}/><p><span style="font-weight: 600;text-transform: uppercase;text-transform: capitalize;font-weight: normal;">JCB</span></p>
                </td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">

                    <input type="checkbox" {{dinner}}/><p><span style="font-weight: 600;text-transform: uppercase;text-transform: capitalize;font-weight: normal;">Dinner</span></p>
                </td>
                <td style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);width:25%">

                    <input type="checkbox" {{other}}/><p><span style="font-weight: 600;text-transform: uppercase;text-transform: capitalize;font-weight: normal;">Other</span></p>
                </td>
            </tr>
            <tr class="table__tr--info" style=" text-transform: uppercase;font-weight: bold;background-color: #d3d3d3;">
                <td colspan="4" style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);">TERM AND CONDITION</td>
            </tr>
            <tr>
                <td class="td-info" colspan="4" style=" padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);padding-top: 10px;line-height: 20px;border: none;border-left: 1px solid #d3d3d3;border-right: 1px solid #d3d3d3;">
                    <span>1. Check-in time is at {{CheckInTime}} - Check out time is at {{CheckOutTime}}<br/></span>
                    <span>2. Smoking is not allowed in all the guest rooms.<br/></span>
                    <span>3. Cooking or any form of meal preparation is not allowed inside the room.<br/></span>
                    <span>4. Adults guests are responsible to supervise their children on the balcony, swimming pool, and in any dangerous area.<br/></span>
                    <span>5. Money, jewelry, and other valuable items should be kept by Guestself.<br/></span>
                    <span>6. Guest also agrees to be personally liable if the indicated person, firm, or corporation fails to pay any of the charges incurred and Guest shall make an immediate payment direct to the hotel.<br/></span>
                    <span>7. We will not be responsible in case of any loss, damage, or injury suffered at the property.</span></td>
            </tr>
            <tr>
                <td class="td-footer" colspan="2" style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);text-align: center;padding-top: 10px;padding-bottom: 100px;width:50%;"><span style="text-transform:none;font-weight: bold;text-transform: uppercase;">Checkin by</span></td>
                <td class="td-footer" colspan="2" style="padding-top: 3px;padding-bottom: 3px;padding-left: 5px;border: 1px solid rgba(0, 0, 0, 0.199);text-align: center;padding-top: 10px;padding-bottom: 100px;width:50%;"><span style="text-transform:none;font-weight: bold;text-transform: uppercase;">Guest\'s Singature</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<br/><br/><br/><br/><br/><br/>
<div class="data"></div>';

        $view2 = '<div class="title" style="text-align: center;margin-top: 10px;text-transform: uppercase;font-size: 20px; font-weight: bold; width:100%; display:flex; justify-content: center;">
    DANH SÁCH NGƯỜI DÙNG
</div>
<table cellspacing="0" style="width:100%; font-size:12px;" border="1">
     <tr>
      <th style="border: 1px solid ;">ID</th>
      <th style="border: 1px solid ;">TÊN NGƯỜI DÙNG</th>
      <th style="border: 1px solid ;">EMAIL</th>
      <th style="border: 1px solid ;">ĐỊA CHỈ</th>
    </tr>
 {{#data}}
   {{#.}}
    <tr>
      <td style="border: 1px solid ;">{{id}}</td>
      <td style="border: 1px solid ;">{{name}}</td>
      <td style="border: 1px solid ;">{{email}}</td>
      <td style="border: 1px solid ;">{{address}}</td>
    </tr>
    {{/.}}
  {{/data}}
</table>';

        DB::table("template_documents")->insert([
            [
                "name" => "Mẫu chung xác nhận đặt phòng",
                "status" => 0,
                "type" => "1",
//                "view" => view('Booking-confirmation.booking-confirmation')->render(), // nếu để đoạn html trong file blade thì mới gọi kiểu này.
            // nên để trong file blade dạng .html bởi vì nếu cần sửa sẽ sửa trực tiếp ở file html blade. Giúp tường minh, dễ nhìn, nếu để quá khó sửa
                'view' => $view1,
            ],
            [
                "name" => "Mẫu chung in hóa đơn",
                "status" => 0,
                "type" => "2",
                "view" => $view2,
            ]
        ]);
    }
}
