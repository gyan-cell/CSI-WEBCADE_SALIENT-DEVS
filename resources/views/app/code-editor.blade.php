@extends(config('app.layout'))
@section('content')
   <style>
    
      .iframe-container {
            position: relative;
            width: 100%;
            max-width: 100%; /* Adjust as needed */
            padding-top: 56.25%; /* 16:9 aspect ratio */
            border-radius: 15px; /* Rounded corners */
            overflow: hidden; /* Ensures the corners are clipped */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            background: white;
        }
        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        }
    </style>
 <div class="iframe-container">
        <iframe src="https://newstudy.salientdevs.com/new/" allowfullscreen></iframe>
    </div>
@endsection
