<a href="{{ route(plural_from_model($obj_name).'.restore', $$obj_name).$args_by_get}}" 
   title="{{ trans('messages.restore') }}"
   data-restore="{{ csrf_token() }}"
   class="restore"
><!--i class="fa-solid fa-trash-arrow-up fa-lg"-->{!! icon('restore') !!}</i></a>
