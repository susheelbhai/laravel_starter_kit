<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from preview.designing-world.com/saasbox-v2.0.0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 Feb 2023 09:00:42 GMT -->
  <head>
    @relativeInclude('head_tag') 
  </head>
  <body>
    <!-- Preloader-->
    <div class="preloader" id="preloader">
      <div class="spinner-grow text-light" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    
    {{ $header }}
    
    {{$slot}}
    
    @relativeInclude('footer')
    @relativeInclude('js')
    
    
  </body>

<!-- Mirrored from preview.designing-world.com/saasbox-v2.0.0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 Feb 2023 09:03:19 GMT -->
</html>