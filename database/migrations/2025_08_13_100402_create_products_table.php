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
        $table->bigIncrements('id'); // bigint [pk, increment]
        $table->unsignedBigInteger('category_id'); // bigint
        $table->string('code', 50)->unique(); // varchar(50) [unique]
        $table->string('name', 150); // varchar(150)
        $table->text('description'); // text
        $table->integer('stock'); // int
        $table->decimal('purchase_price', 15, 2); // decimal(15,2)
        $table->decimal('selling_price', 15, 2); // decimal(15,2)
        $table->timestamp('created_at')->useCurrent(); // timestamp
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // timestamp

        // Foreign key
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
