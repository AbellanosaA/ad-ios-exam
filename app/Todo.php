<?php // File: app/Post.php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Corcel\Model\Post as Corcel;

class Todo extends Corcel
{
	protected $postType = 'todo';
    protected $connection = 'wordpress';    
}