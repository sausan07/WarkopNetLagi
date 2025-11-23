<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'WarkopNet - Forum Diskusi' }}</title>
    
  
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&family=Funnel+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    
   
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .font-utama { font-family: "Bricolage Grotesque", sans-serif; } .font-accent { font-family: "Funnel Sans", sans-serif; }
    </style>
    
    @livewireStyles
</head>
<body class="bg-[#FFF8F0] font-accent text-[#373737]">
    
    @yield('content')
    

</body>
</html>
