@extends('layouts.app')
@section('title','Finalizing')
@section('content')
<style>
#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 1%;
  height: 30px;
  background-color: #4CAF50;
}
</style>

@if(Auth::user())
<form action="{{ route('mornings.store') }}" method="post">
		<div  style="display:none" class="form-group">
    <label for="title">user id:</label>
    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Rock:</label>
    <input type="hidden" id="Rock" name="Rock" value="0">
    </div> 
    <div  style="display:none" class="form-group">
    <label for="title">Pop:</label>
    <input type="hidden" id="Pop" name="Pop" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Metal:</label>
    <input type="hidden" id="Metal" name="Metal" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Bhajan:</label>
    <input type="hidden" id="Bhajan" name="Bhajan" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Alternative:</label>
    <input type="hidden" id="Alternative" name="Alternative" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Dance:</label>
    <input type="hidden" id="Dance" name="Dance" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">RnB:</label>
    <input type="hidden" id="RnB" name="RnB" value="0">
    </div>
    <div  style="display:none"class="form-group">
    <label for="title">HipHop:</label>
    <input type="hidden" id="HipHop" name="HipHop" value="0">
    </div>
    <div  style="display:none"class="form-group">
    <label for="title">Country:</label>
    <input type="hidden" id="Country" name="Country" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Classic:</label>
    <input type="hidden" id="Classic" name="Classic" value="0">
    </div>
    <div   style="display:none"class="form-group">
    <label for="title">Instrumental:</label>
    <input type="hidden" id="Instrumental" name="Instrumental" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Romance:</label>
    <input type="text"  style="display:none" id="Romance" name="Romance" value="0">
    </div>
    <div class="form-group">
                <div id="myProgress">
  <div id="myBar"></div>
</div>

<br>
<button type="submit"  onclick="move()" >morning</button>
     </div>
     </div>
	{{ csrf_field() }}
	</form>

  <form action="{{ route('evenings.store') }}" method="post">
		<div  style="display:none" class="form-group">
    <label for="title">user id:</label>
    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Rock:</label>
    <input type="hidden" id="Rock" name="Rock" value="0">
    </div> 
    <div  style="display:none" class="form-group">
    <label for="title">Pop:</label>
    <input type="hidden" id="Pop" name="Pop" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Metal:</label>
    <input type="hidden" id="Metal" name="Metal" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Bhajan:</label>
    <input type="hidden" id="Bhajan" name="Bhajan" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Alternative:</label>
    <input type="hidden" id="Alternative" name="Alternative" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Dance:</label>
    <input type="hidden" id="Dance" name="Dance" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">RnB:</label>
    <input type="hidden" id="RnB" name="RnB" value="0">
    </div>
    <div  style="display:none"class="form-group">
    <label for="title">HipHop:</label>
    <input type="hidden" id="HipHop" name="HipHop" value="0">
    </div>
    <div  style="display:none"class="form-group">
    <label for="title">Country:</label>
    <input type="hidden" id="Country" name="Country" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Classic:</label>
    <input type="hidden" id="Classic" name="Classic" value="0">
    </div>
    <div   style="display:none"class="form-group">
    <label for="title">Instrumental:</label>
    <input type="hidden" id="Instrumental" name="Instrumental" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Romance:</label>
    <input type="text"  style="display:none" id="Romance" name="Romance" value="0">
    </div>
    <div class="form-group">
                <div id="myProgress">
  <div id="myBar"></div>
</div>

<br>
<button type="submit"  onclick="move()" >evening</button>
     </div>
     </div>
	{{ csrf_field() }}
	</form>

  <form action="{{ route('noons.store') }}" method="post">
		<div  style="display:none" class="form-group">
    <label for="title">user id:</label>
    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Rock:</label>
    <input type="hidden" id="Rock" name="Rock" value="0">
    </div> 
    <div  style="display:none" class="form-group">
    <label for="title">Pop:</label>
    <input type="hidden" id="Pop" name="Pop" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Metal:</label>
    <input type="hidden" id="Metal" name="Metal" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Bhajan:</label>
    <input type="hidden" id="Bhajan" name="Bhajan" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Alternative:</label>
    <input type="hidden" id="Alternative" name="Alternative" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Dance:</label>
    <input type="hidden" id="Dance" name="Dance" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">RnB:</label>
    <input type="hidden" id="RnB" name="RnB" value="0">
    </div>
    <div  style="display:none"class="form-group">
    <label for="title">HipHop:</label>
    <input type="hidden" id="HipHop" name="HipHop" value="0">
    </div>
    <div  style="display:none"class="form-group">
    <label for="title">Country:</label>
    <input type="hidden" id="Country" name="Country" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Classic:</label>
    <input type="hidden" id="Classic" name="Classic" value="0">
    </div>
    <div   style="display:none"class="form-group">
    <label for="title">Instrumental:</label>
    <input type="hidden" id="Instrumental" name="Instrumental" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Romance:</label>
    <input type="text"  style="display:none" id="Romance" name="Romance" value="0">
    </div>
    <div class="form-group">
                <div id="myProgress">
  <div id="myBar"></div>
</div>

<br>
<button type="submit"  onclick="move()" >noon</button>
     </div>
     </div>
	{{ csrf_field() }}
	</form>

  <form action="{{ route('nights.store') }}" method="post">
		<div  style="display:none" class="form-group">
    <label for="title">user id:</label>
    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Rock:</label>
    <input type="hidden" id="Rock" name="Rock" value="0">
    </div> 
    <div  style="display:none" class="form-group">
    <label for="title">Pop:</label>
    <input type="hidden" id="Pop" name="Pop" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Metal:</label>
    <input type="hidden" id="Metal" name="Metal" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Bhajan:</label>
    <input type="hidden" id="Bhajan" name="Bhajan" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Alternative:</label>
    <input type="hidden" id="Alternative" name="Alternative" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Dance:</label>
    <input type="hidden" id="Dance" name="Dance" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">RnB:</label>
    <input type="hidden" id="RnB" name="RnB" value="0">
    </div>
    <div  style="display:none"class="form-group">
    <label for="title">HipHop:</label>
    <input type="hidden" id="HipHop" name="HipHop" value="0">
    </div>
    <div  style="display:none"class="form-group">
    <label for="title">Country:</label>
    <input type="hidden" id="Country" name="Country" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Classic:</label>
    <input type="hidden" id="Classic" name="Classic" value="0">
    </div>
    <div   style="display:none"class="form-group">
    <label for="title">Instrumental:</label>
    <input type="hidden" id="Instrumental" name="Instrumental" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Romance:</label>
    <input type="text"  style="display:none" id="Romance" name="Romance" value="0">
    </div>
    <div class="form-group">
                <div id="myProgress">
  <div id="myBar"></div>
</div>

<br>
<button type="submit"  onclick="move()" >night</button>
     </div>
     </div>
	{{ csrf_field() }}
	</form>

  <form action="{{ route('latenights.store') }}" method="post">
		<div  style="display:none" class="form-group">
    <label for="title">user id:</label>
    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Rock:</label>
    <input type="hidden" id="Rock" name="Rock" value="0">
    </div> 
    <div  style="display:none" class="form-group">
    <label for="title">Pop:</label>
    <input type="hidden" id="Pop" name="Pop" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Metal:</label>
    <input type="hidden" id="Metal" name="Metal" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Bhajan:</label>
    <input type="hidden" id="Bhajan" name="Bhajan" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Alternative:</label>
    <input type="hidden" id="Alternative" name="Alternative" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Dance:</label>
    <input type="hidden" id="Dance" name="Dance" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">RnB:</label>
    <input type="hidden" id="RnB" name="RnB" value="0">
    </div>
    <div  style="display:none"class="form-group">
    <label for="title">HipHop:</label>
    <input type="hidden" id="HipHop" name="HipHop" value="0">
    </div>
    <div  style="display:none"class="form-group">
    <label for="title">Country:</label>
    <input type="hidden" id="Country" name="Country" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Classic:</label>
    <input type="hidden" id="Classic" name="Classic" value="0">
    </div>
    <div   style="display:none"class="form-group">
    <label for="title">Instrumental:</label>
    <input type="hidden" id="Instrumental" name="Instrumental" value="0">
    </div>
    <div  style="display:none" class="form-group">
    <label for="title">Romance:</label>
    <input type="text"  style="display:none" id="Romance" name="Romance" value="0">
    </div>
    <div class="form-group">
  <button type="submit"  onclick="move()" >late night</button>      
  <div id="myProgress">
  <div id="myBar"></div>
  </div>

     </div>
	{{ csrf_field() }}
	</form>
  @endif
  <script>
function move() {
  var elem = document.getElementById("myBar");   
  var width = 1;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
    }
  }
}
</script>
@endsection