<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE TABLE `users` (
          `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'site user id',
          `first_name` varchar(255) NOT NULL COMMENT 'user first name',
          `last_name` varchar(255) NOT NULL COMMENT 'user last name',
          `email` varchar(255) NOT NULL COMMENT 'user email address',
          `mobile` varchar(50) COMMENT 'mobile number with isd, without + sign',
          `avatar_id` int(11) NOT NULL DEFAULT '0' COMMENT 'storage.id',
          `is_locked` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:not locked; 1: locked',
          `is_email_verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:not verified;1:verified',
          `is_mobile_verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:not verified;1:verified',
          `gender` varchar(10) COMMENT 'use constant',
          `password` varchar(255) NOT NULL DEFAULT '0000-00-00' COMMENT 'user password',
          `date_of_birth` date NOT NULL COMMENT 'date of birth',
          `terms_accepted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:no;1:yes',
          `registered_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'row entry timestamp',
           PRIMARY KEY (id),
           UNIQUE KEY `email` (`email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        DB::statement($sql);
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
};
