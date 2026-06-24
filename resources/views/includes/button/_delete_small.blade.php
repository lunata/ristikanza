@include('includes.button._delete', 
        ['is_button'=> 1, 
         'without_text' => 1,
         'route' => plural_from_model($obj_name).'.destroy', 
         'obj' => $$obj_name,
         'args'=>[$obj_name => $$obj_name->id]])
