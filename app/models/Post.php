<?php

class Post extends Eloquent
{
		/**
	     * Validation rules
	     */
		protected $guarded = array();

	    public static $rules = array(
	    	'title' => 'required|unique',
	    	'body' => 'required'
	    );

	  
}