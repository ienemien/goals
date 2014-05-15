<?php

// app/models/Goal.php

class Goal extends Eloquent {
        // let eloquent know that these attributes will be available for mass assignment
	protected $fillable = array('title', 'done');
	protected $guarded = array('id');
}
