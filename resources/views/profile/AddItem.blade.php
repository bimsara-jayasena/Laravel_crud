<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new Item</title>
</head>

<body>
@if(session('success'))
    <div>{{session('success')}}</div>
    @endif
    <h1>Add Item</h1>

    <form action="{{route('item.store')}}" method="POST" id="form">
        @csrf
       
        <input type="text" name="item_name" id="name" placeholder="item name"><br>
        <input type="number" name="price" id="price" placeholder="price"><br>
        <input type="number" name="quantity" id="name" placeholder="quantity"><br>
        
        <select name="catagory" id="catagory" onchange="setAction()">
            @foreach($categories as $category)
            
            <option value="{{$category['catagory']}}">{{$category['catagory']}}</option>
            @endforeach
        </select>
        <input type="submit" value="Save" onclick="send()">
    </form>
    <a href="{{route('dashboard')}}">back to dashboard</a>
    <script>
            function setAction(){
                const id=document.getElementById('catagory').value;
                document.getElementById('id').value=id;
                console.log(id)
            }
    </script>
</body>

</html>