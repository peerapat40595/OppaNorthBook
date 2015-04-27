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
        // Creates the books table
        Schema::create('books', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('ISBN');
            $table->string('barcode');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('language')->nullable();
            $table->datetime('pub_date')->nullable();
            $table->string('edition')->nullable();
            $table->string('type')->nullable();
            $table->decimal('cover_price', 6, 2);
            $table->decimal('sell_price', 6, 2);
            $table->string('publisher_name');
            $table->boolean('availability')->default(true);
            $table->integer('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');   
            $table->integer('page')->nullable();      
            $table->integer('width')->nullable();
            $table->integer('high')->nullable();
            $table->integer('deep')->nullable();
            $table->integer('weight')->nullable();
            $table->string('cover_pic')->default('http://www.gordini.ca/static/img/image_not_available.gif');
            $table->string('back_pic');
            $table->string('first_pic');
            $table->timestamps();
        });
        // 
        Schema::create('book_has_supplier',function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('buy_price', 6, 2);
            $table->integer('buy_amount');
            $table->integer('lot_no');
            $table->datetime('buy_date');
            $table->timestamps();
        });
         // Creates the suppliers table
        Schema::create('suppliers', function($table)
        {
             $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('tel');
            $table->string('room_number');
            $table->string('building');
            $table->string('address');
            $table->string('street');
            $table->string('distinct');
            $table->string('provice');
            $table->string('zip_code');
            $table->timestamps();
        });
        // Creates the authors table
        Schema::create('authors', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('prefix')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('pseudonym')->nullable();
            $table->timestamps();
        });
        // Creates the book_has_author table
        Schema::create('book_has_author', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
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
            $table->string('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('translator_id')->references('id')->on('translators')->onDelete('cascade')->onUpdate('cascade');
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
            $table->string('book_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        // Creates the categories table
        Schema::create('categories', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('sub_categories', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('parent_category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->timestamps();
        });


        // Creates the users table
        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->text('remember_token')->nullable();
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('tel')->nullable();
           // $table->string('mobilephonenumber');
           // $table->text('address');
            $table->string('room_number')->nullable();
            $table->string('floor')->nullable();
            $table->string('building')->nullable();
            $table->string('address_no')->nullable();
            $table->string('street')->nullable();
            $table->string('distinct')->nullable();
            $table->string('sub_distinct')->nullable(); 
            $table->string('provice')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->boolean('isadmin')->default(0);
            $table->boolean('issp')->default(0);
            $table->boolean('banned')->default(0);
            $table->decimal('point',7,2)->nullable();
            $table->decimal('amount_spent', 12, 2)->nullable();
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
            $table->string('payment_type')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('confirmed')->default(0);
            $table->string('image_path'); 
            $table->string('EMS_No'); 
            $table->decimal('total_price', 10, 2);
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
            $table->decimal('total_cost', 8, 2);; 
            $table->unsignedInteger('amount')->default(0);
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
