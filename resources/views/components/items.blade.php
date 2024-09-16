@if(session('duplicate'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        duplicateHandler();
    })
</script>
@endif


<section class="relative  w-full h-full flex flex-col justify-center items-center " id="items">

    <section id="item-view-container" class="absolute w-full h-full ">
        @if(session('action'))
        <div>{{session('action')}}</div>
        @endif
        <div class="w-full flex justify-end p-1 gap-1">
            <div class="border flex">

                <form action="{{ route('search')}}" method="get" id="searchForm">
                    <label for="search_type">Find by</label>
                    <select name="search_type" id="search_type">

                        <option value="name" selected>Item Name</option>
                        <option value="catagory">Item category</option>
                        <option value="price">Item price</option>
                    </select>
                    <input type="text" name="search_key" id="key" placeholder="Find Item"><br>

                </form>
                <button id="find" onclick="handleSearch()" class=" rounded bg-blue-500 p-1 text-white font-bold w-[10rem] hover:bg-blue-400">Find</button>
            </div>
            <form action="{{route ('dashboard')}}" id="refreshFrom">
                <input type="submit" value="">
            </form>
            <button id="back" onclick="back()" class="rounded bg-blue-500 p-1 text-white font-bold w-[5rem] hover:bg-blue-400 flex flex justify-center items-center "><img src="{{asset('refresh.png')}}" alt="" class="h-[1.5rem]"></button>

            <button class="rounded bg-blue-500 p-1 text-white font-bold w-[10rem] hover:bg-blue-400  " onclick="createItem()">Add new item</button></a>
        </div>
        <div class="overflow-y-auto h-[90%]">
            <table class="text-center w-full ">
                <thead class="sticky top-0 w-full bg-slate-500 text-[1.5rem] text-white">
                    <tr>
                        <th class="hidden">id</th>
                        <th class="p-1">name</th>
                        <th class="p-1">quantity</th>
                        <th class="p-1">category</th>
                        <th class="p-1">price</th>
                        <th class="p-1"></th>
                    </tr>
                </thead>
                <tbody class="border border-white bg-gray-100 text-[1rem]">
                    @foreach($items as $item)
                    <tr id="{{$item['id']}}" class="border border-white">
                        <td class="hidden">{{$item['id']}}</td>
                        <td class="p-1">{{$item['item_name']}}</td>
                        <td class="p-1">{{$item['quantity']}}</td>
                        <td class="p-1">{{$item['catagory']}}</td>
                        <td class="p-1">{{$item['price']}}</td>
                        <td class="p-1">
                            <button onclick="updateItem(this)" class=" rounded bg-sky-500 p-1 text-white font-bold m-1 w-[5rem] hover:bg-sky-400">Update</button>
                            <button onclick="removeItem(this)" class="rounded bg-red-500 p-1 text-white font-bold w-[5rem] hover:bg-red-400">Delete</button>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </section>
    <section id="item-create-container" class="absolute scale-[0]">


        <div class="w-[60vw] h-[80vh] text-white  rounded bg-slate-800 flex   flex-col items-center" id="itemCreate">
            <!-- close -button-->
            <div class="related  w-full h-[5rem] flex justify-end p-5">
                <button class=" bg-red-500 rounded w-[2.5rem] h-[2.5rem] text-xl font-bold  hover:bg-red-400" onclick="closeForm(this)">X</button>
            </div>

            <!-- tite -->
            <h2 class="absolut text-[5rem] text-center ">create item</h2>
            <div class="w-full bg-red-500 h-[10rem] flex items-center justify-center opacity-[0]" id="createError">

                <h1 class="text-xl text-center " id="create-error-text">error</h1>

            </div>
            <!-- form -->
            <div class="relative  w-full h-full flex flex-col justify-center items-center mt-[-5rem] ">
                <form action="{{route('item.store')}}" method="POST" id="form" class="flex justify-center items-center flex-col text-slate-800">
                    @csrf
                    <input type="hidden" name="action">
                    <input type="text" name="item_name" id="name" placeholder="item name" class="w-[20rem] mb-2"><br>
                    <input type="number" name="price" id="price" placeholder="price" class="w-[20rem] mb-2"><br>
                    <input type="number" name="quantity" id="qty" placeholder="quantity" class="w-[20rem] mb-2"><br>

                    <select name="catagory" id="catagory" onchange="setAction()" class="w-[20rem] mb-2">
                        @foreach($categories as $category)

                        <option value="{{$category['catagory']}}" class="">{{$category['catagory']}}</option>
                        @endforeach
                    </select><br>

                </form>

                <button onclick="handleCreate()" class="rounded bg-sky-500 p-1 text-white font-bold w-[10rem] hover:bg-sky-400  ">Save</button>
            </div>


        </div>
    </section>
    <section id="item-update-container" class="absolute scale-[0]">
        <div class="w-[60vw] h-[80vh] text-white  rounded bg-slate-800 flex  flex-col " id="itemUpdate">
            <!-- close -button-->
            <div class="related  w-full h-[5rem] flex justify-end p-5">
                <button class=" bg-red-500 rounded w-[2.5rem] h-[2.5rem] text-xl font-bold  hover:bg-red-400" onclick="closeForm(this)">X</button>
            </div>
            <!-- tite -->
            <h2 class="absolut text-[5rem] text-center ">update item</h2>
            <div class="w-full bg-red-500 h-[10rem] flex items-center justify-center opacity-[0]" id="updateError">

                <h1 class="text-xl text-center " id="update-error-text">error</h1>

            </div>

            <div class="relative  w-full h-full flex flex-col justify-center items-center">
                <form action="" method="post" id="update-item-form" class="flex justify-center items-center flex-col text-slate-800">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="item_name" id="item" placeholder="item name" class="w-[20rem] mb-2"><br>
                    <input type="number" name="quantity" id="quantity" placeholder="quantity" class="w-[20rem] mb-2" readonly><br>
                    <input type="number" name="price" id="item_price" placeholder="price" class="w-[20rem] mb-2"><br>
                    <input type="text" name="catagory" id="category" placeholder="category" class="w-[20rem] mb-2" readonly><br>

                </form>
                <button onclick="handleUpdate()" class="rounded bg-sky-500 p-1 text-white font-bold w-[10rem] hover:bg-sky-400  ">Send</button>
            </div>

        </div>
    </section>
    <section id="item-delete-container" class="absolute scale-[0]">
        <div class="w-[50vw] h-[50vh] text-white  rounded bg-slate-800 flex  flex-col " id="itemUpdate">
            <!-- close -button-->
            <div class="related  w-full h-[5rem] flex justify-end p-5">
                <button class=" bg-red-500 rounded w-[2.5rem] h-[2.5rem] text-xl font-bold  hover:bg-red-400" onclick="closeForm(this)">X</button>
            </div>
           
            <!-- tite -->
            <h2 class="absolut text-[2rem] text-center mt-4">Remove Item</h2>


            <div class="relative  w-full h-full flex flex-col justify-center items-center gap-1 -translate-y-[2rem]">
                <form action="" method="post" id="delete-item-form">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" id="delete_action" name="delete_action">

                    <div class="flex ">
                        <div>
                            <input type="radio" name="action" id="single" class="hidden peer">
                            <label for="single" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-red-500 peer-checked:border-red-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Delete one item</div>

                                </div>
                            </label>

                        </div>

                        <div>
                            <input type="radio" name="action" id="all" class="hidden peer">
                            <label for="all" class="inline-flex items-center justify-between w-[10rem]  p-5  text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-red-500 peer-checked:border-red-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block w-full text-center">
                                    <div class="w-full text-lg font-semibold">Delete All</div>

                                </div>
                            </label>
                        </div>
                    </div>


                  

                </form>
                <button onclick="handleDelete()" class="border  rounded p-1 mt-2 w-[20rem] hover:bg-red-800 hover:curser-pointer">Remove</button>

            </div>

        </div>
    </section>
    <section id="item-duplicate-container" class="absolute scale-[0]">
        <div class="w-[65vw] h-[50vh] text-white  rounded bg-slate-800 flex  flex-col p-1" id="duplicate">
            <!-- close -button-->
            <div class="related  w-full h-[5rem] flex justify-end p-5">
                <button class=" bg-red-500 rounded w-[2.5rem] h-[2.5rem] text-xl font-bold  hover:bg-red-400" onclick="closeForm(this)">X</button>
            </div>
            <!-- tite -->
            <h2 class="absolut text-[2rem] text-center mt-4"> Duplicate Item Found </h2>
            <h3 class="absolut text-[1.5rem] text-center mt-4"> Duplicate Item Found with different values,do you want to update the Existing item or add this item as new one ?</h3>

            <div class="relative  w-full h-full flex  justify-center items-center gap-1">
                <form action="{{route('item.store')}}" method="POST" id="duplicate-item-form" class="text-black">
                    @csrf
                    <input type="text" name="item_name" value="{{ old('item_name') }}" placeholder="Item Name">
                    <input type="number" name="price" value="{{ old('price') }}" placeholder="Price">
                    <input type="text" name="catagory" value="{{ old('catagory') }}" placeholder="Category">
                    <input type="number" name="quantity" value="{{ old('quantity') }}" placeholder="Quantity">
                    <input type="hidden" name="user_action" id="user_action">
                    <br>
                    <button id="save" type="button" value="Save" onclick="duplicateFormHandler('save') " class="rounded bg-sky-500 p-1 text-white font-bold w-fit hover:bg-sky-400  ">save</button>
                    <button id="update" type="button" value="Update Item" onclick="duplicateFormHandler('update')" class="border rounded p-1 hover:bg-sky-400 hover:curser-pointer">update</button>

                </form>

            </div>

        </div>


    </section>
    <img src="{{ asset('refresh.png') }}" class="w-[10rem]" alt="refresh">
</section>

<script>
    window.onload = function() {
        document.getElementById('searchForm').reset();
    };

    function handleSearch() {
        document.getElementById('find').classList.replace('block', 'hidden');
        document.getElementById('back').classList.replace('hidden', 'block');
        const form = document.getElementById('searchForm');
        const searchKey = document.getElementById('search_type').value;
        const keyWord = document.getElementById('key').value;
        console.log(searchKey, keyWord);

        form.submit();
    }

    function back() {
       
        const form = document.getElementById('refreshFrom');
        form.submit();
       

    }

    function errorHandler(containerId, textId, msg) {
        console.log(msg)
        const component = document.getElementById(containerId);
        document.getElementById(textId).innerText = msg;
        component.classList.replace('opacity-[0]', 'opacity-[1]');
        component.classList.add('transition');
        component.classList.add('ease-in');
        component.classList.add('duration-150');
        setTimeout(() => {
            component.classList.replace('opacity-[1]', 'opacity-[0]');
            component.classList.add('transition');
            component.classList.add('ease-in');
            component.classList.add('duration-150');
        }, 3000);

    }


    function showItems() {
        const item = document.getElementById('items');
        const category = document.getElementById('categories');
        item.classList.replace('hidden', 'flex');
        category.classList.replace('flex', 'hidden');
    }

    function handleCreate() {
        const form = document.getElementById('form');
        const price = document.getElementById('price').value;
        const quantity = document.getElementById('qty').value;
        const containerId = 'createError';
        const textId = 'create-error-text';
        if (price <= 0) {

            errorHandler(containerId, textId, 'price cannot be 0 or minus value');
        } else if (quantity <= 0) {
            errorHandler(containerId, textId, 'quantity cannot be lower than one')
        } else {
            form.submit();
        }
    }

    function handleUpdate() {
        const form = document.getElementById('update-item-form');
        const qty = document.getElementById('quantity').value;
        const price = document.getElementById('item_price').value;
        const containerId = 'updateError';
        const textId = 'update-error-text';
        if (price <= 0) {
            errorHandler(containerId, textId, 'price cannot be 0 or minus value');
        } else if (qty <= 0) {
            errorHandler(containerId, textId, 'quantity cannot be lower than one')
        } else {
            form.submit();
        }

    }



    function duplicateHandler() {

        const component = document.getElementById('item-duplicate-container');
        component.classList.replace('scale-[0]', 'scale-[100%]');


    }

    function duplicateFormHandler(action) {
        console.log(action);
        document.getElementById('user_action').value = action;
        const form = document.getElementById('duplicate-item-form');
        form.submit();



    }

    function createItem() {
        const component = document.getElementById('item-create-container');
        component.classList.replace('scale-[0]', 'scale-[100%]');
        component.classList.add('transition');
        component.classList.add('duration-150');
        component.classList.add('ease-in');
        console.log("item create")
    }

    function closeForm(button) {
        console.log('done')
        $component = button.parentElement.parentElement.parentElement;

        $component.classList.replace('scale-[100%]', 'scale-[0]');
        $component.classList.add('transition');
        $component.classList.add('duration-150');
        $component.classList.add('ease-out');
    }

    function updateItem(button) {
        console.log('check check')

        const fromContainer = document.getElementById('item-update-container');
        fromContainer.classList.replace('scale-[0]', 'scale-[100%]');
        fromContainer.classList.add('transition');
        fromContainer.classList.add('duration-150');
        fromContainer.classList.add('ease-in');

        let data = button.parentElement.parentElement;
        let id = data.children[0].innerText;
        let item = data.children[1].innerText;
        let quantity = data.children[2].innerText;
        let category = data.children[3].innerText;
        let price = data.children[4].innerText;

        console.log(price);
        const form = document.getElementById('update-item-form');
        document.getElementById('item').value = item;
        document.getElementById('quantity').value = quantity;
        document.getElementById('item_price').value = price;
        document.getElementById('category').value = category;
        form.action = "/item/" + id;
    }

    function handleDelete() {
        const single = document.getElementById('single').checked;
        const all = document.getElementById('all').checked;

        const form = document.getElementById('delete-item-form');
        if (single) {
            document.getElementById('delete_action').value = 'single';

        } else if (all) {
            document.getElementById('delete_action').value = 'all';
        }
        form.submit();
    }

    function removeItem(button) {
        const fromContainer = document.getElementById('item-delete-container');
        fromContainer.classList.replace('scale-[0]', 'scale-[100%]');
        fromContainer.classList.add('transition');
        fromContainer.classList.add('duration-150');
        fromContainer.classList.add('ease-in');

        let data = button.parentElement.parentElement;
        let id = data.children[0].innerText;
        let name = data.children[1].innerText;
        console.log(name);
        const form = document.getElementById('delete-item-form');
        document.getElementById('itemName').innerText = name;
        form.action = "/item/" + id;
    }
</script>