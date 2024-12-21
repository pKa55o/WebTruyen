<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('chapters', function (Blueprint $table) {
            // Đảm bảo các cột đã có hoặc thêm cột mới nếu cần
            if (!Schema::hasColumn('chapters', 'truyen_id')) {
                $table->unsignedBigInteger('truyen_id')->after('id');
            }
            if (!Schema::hasColumn('chapters', 'chapter_number')) {
                $table->integer('chapter_number')->after('truyen_id');
            }
            if (!Schema::hasColumn('chapters', 'ten_chapter')) {
                $table->string('ten_chapter', 255)->after('chapter_number');
            }
            if (!Schema::hasColumn('chapters', 'content')) {
                $table->binary('content')->after('ten_chapter');
            }
            $table->timestamps(); // Thêm timestamps nếu chưa có
        });
    }

 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chapters', function (Blueprint $table) {
            // Xóa các cột đã thêm nếu rollback
            $table->dropColumn(['truyen_id', 'chapter_number', 'ten_chapter', 'content']);
        });
    }
}