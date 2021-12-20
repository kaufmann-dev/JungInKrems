<?php
 
namespace Tests\Browser;
 
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;
 
class ExampleTest extends DuskTestCase
{
    use DatabaseMigrations;
}