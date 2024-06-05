<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Tạo cột ID tự tăng
            $table->string('name'); // Tên sản phẩm
            $table->string('slug'); // Slug
            $table->decimal('price', 8, 2); // Giá sản phẩm
            $table->integer('quantity')->default(0);
            $table->string('feature_image_name')->nullable();
            $table->string('feature_image_path')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('description')->nullable(); // Mô tả có thể null
            $table->unsignedBigInteger('brand_id')->nullable(); // ID của thương hiệu, là khóa ngoại
            $table->tinyInteger('status')->default(1);
            $table->timestamps(); // Tạo cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
