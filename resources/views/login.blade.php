<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <div class="login-container">
        
       
        <form action="{{ route('login') }}" method="POST" class="login-form">
            @if (session('status'))
        <div class="error-message-container ta-c">
            <p class="error-message">
                {{  session('status')  }}
            </p>
           
        </div>
       
        @endif
            @csrf
            <h3 class="form-title">Login</h3>
            <div class="form-control">
              
                <input type="email" value="{{ old('email') }}" name="email" placeholder="email" class="@error('email') red-border  @enderror">
            </div>
            @error('email')
               
                    <div class="error-message-container">
                        <p class="error-message">
                            {{ $message }}
                        </p>
                       
                    </div>
                   
             
            
                @enderror
            <div class="form-control">
             
                <input type="password" name="password" value="{{ old('password') }}" placeholder="password" class="@error('password') red-border  @enderror">
            </div>  
            @error('password')
               
            <div class="error-message-container">
                <p class="error-message">
                    {{ $message }}
                </p>
               
            </div>
           
     
    
        @enderror
            <button type="submit" class="btn">Login</button>
        </form>

    </div>
    
</body>
</html>