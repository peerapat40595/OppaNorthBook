<?php
use Illuminate\Database\Migrations\Migration;

class ConfideSetupUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Creates the products table
        Schema::create('products', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->decimal('price', 6, 2);
            $table->integer('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('availability')->default(true);
            $table->string('product_pic');
            $table->timestamps();
        });
        // Creates the books table
        Schema::create('books', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('ISBN')->unique();
            $table->string('barcode')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('language');
            $table->datetime('publish_date')->nullable();
            $table->string('edition');
            $table->string('type');
            $table->integer('rating');
            $table->decimal('price', 6, 2);
            $table->integer('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('publisher_id')->references('id')->on('publishers')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('availability')->default(true);
            $table->string('cover_pic');
            $table->timestamps();
        });
        // Creates the suppliers table
        Schema::create('suppliers', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->string('email');
            $table->string('mobilephonenumber');
            $table->string('room_number');
            $table->string('building');
            $table->string('address');
            $table->string('street');
            $table->string('distinct');
            $table->string('provice');
            $table->string('zip_code');
            $table->timestamps();
        });
         // Creates the publishers table
        Schema::create('publishers', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
         // Creates the vendors table
        Schema::create('vendors', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('vendor_id')->references('id')->on('vendors')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        // Creates the attributes table
        Schema::create('attributes', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('type');
            $table->integer('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        // Creates the authors table
        Schema::create('authors', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('prefix');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('pseudonym');
            $table->timestamps();
        });
        // Creates the book_has_author table
        Schema::create('book_has_author', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('book_ISBN')->references('ISBN')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('author_id')->references('id')->on('authors')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        // Creates the translators table
        Schema::create('translators', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('prefix');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('pseudonym');
            $table->timestamps();
        });
        // Creates the book_has_translator table
        Schema::create('book_has_translator', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('book_ISBN')->references('ISBN')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('translator_id')->references('id')->on('translators')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        // Creates the brands table
        Schema::create('brands', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });
        // Creates the tags table
        Schema::create('tags', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });
        // Creates the book_has_tag table
        Schema::create('book_has_tag', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('book_ISBN')->references('ISBN')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        // Creates the categories table
        Schema::create('categories', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->integer('parent_category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        // Creates the users table
        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->text('remember_token');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('mobilephonenumber');
            $table->text('address');
            $table->string('room_number');
            $table->string('building');
           // $table->string('address');
            $table->string('street');
            $table->string('distinct');
            $table->string('provice');
            $table->string('zip_code');
            $table->string('confirmation_code');
            $table->boolean('confirmed')->default(false);
            $table->boolean('isadmin')->default(0);
            $table->boolean('issp')->default(0);
            $table->boolean('banned')->default(0);
            $table->string('sp_code')->default('admin');
            $table->string('resp_sp_code')->default(0);
            $table->decimal('point',7,2);
            $table->timestamps();
        });
        //order_has_book
         Schema::create('user_has_category',function($table)
        {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        
        Schema::create('orders',function($table)
        {
            $table->increments('id');
            $table->integer('status')->default(0);
            $table->datetime('ordered_at')->nullable(); //nullable?
            $table->datetime('paid_at')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('confirmed')->default(0);
            $table->string('image_path'); 
            $table->timestamps();
        });
         Schema::create('order_lists',function($table)
        {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('amount')->default(0);
            $table->decimal('total_cost', 8, 2);; 
            $table->timestamps();
        });
          //order_has_book
         Schema::create('order_has_book',function($table)
        {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('amount')->default(0);
            $table->decimal('total_cost', 8, 2);; 
            $table->timestamps();
        });

          Schema::create('order_list_attributes',function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('type');
            $table->integer('order_list_id')->references('id')->on('order_lists')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        // Creates password reminders table
        Schema::create('password_reminders', function($t)
        {
            $t->string('email');
            $t->string('token');
            $t->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('password_reminders');
        Schema::drop('users');
        Schema::drop('orders');
        Schema::drop('order_lists');
        Schema::drop('confirmations');
        Schema::drop('customers');
    }

}
