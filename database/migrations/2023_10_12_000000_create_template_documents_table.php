<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_documents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('Tên mẫu tài liệu');
            $table->integer('status')->nullable()->comment('Trạng thái (0-Ngừng sử dụng, 1-Đang sử dụng)');
            $table->string('type')->nullable()->comment('Loại mẫu tài liệu');
            $table->text('view')->nullable()->comment('Text lưu html');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
