 <section class="relative border  w-full h-full flex flex-col justify-center items-center hidden" id="categories">

     <section id="category-view-container" class="absolute w-full h-full">
         <div class="w-full flex justify-end p-1"><a><button class="rounded bg-blue-500 p-1 text-white font-bold w-[10rem] hover:bg-blue-400  " onclick="createCategory()">new</button></a></div>
         <div class="overflow-y-auto h-[90%]">
             <table class="text-center w-full ">
                 <thead class="sticky top-0 w-full bg-slate-500 text-[1.5rem] text-white">
                     <tr>
                         <th class="hidden">id</th>
                         <th class="p-1">name</th>
                         <th class="p-1">quantity</th>
                         <th class="p-1"></th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach($categories as $category)
                     <tr id="{{$category['id']}}" class="border">
                         <td class="hidden">{{$category['id']}}</td>
                         <td class="p-1">{{$category['catagory']}}</td>
                         <td class="p-1">{{$category['quantity']}}</td>
                         <td class="p-1">
                             <button onclick="updateCategory(this)" class=" rounded bg-sky-500 p-1 text-white font-bold m-1 w-[5rem] hover:bg-sky-400">Update</button>
                             <button onclick="removeCategory(this)" class=" rounded bg-red-500 p-1 text-white font-bold m-1 w-[5rem] hover:bg-red-400">Delete</button>
                         </td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </section>

     <section id="category-create-container" class="absolute scale-[0]">


         <div class="w-[60vw] h-[80vh] text-white  rounded bg-slate-800 flex  flex-col " id="categoryCreate">

             <div class="related  w-full h-[5rem] flex justify-end p-5">
                 <button class=" bg-red-500 rounded w-[2.5rem] h-[2.5rem] text-xl font-bold  hover:bg-red-400" onclick="closeForm(this)">X</button>
             </div>

             <h2 class="absolut text-[5rem] text-center ">create category</h2>

             <div class="relative  w-full h-full flex flex-col justify-center items-center">

                 <form action="{{route('category.store')}}" method="POST" id="form" class="flex justify-center items-center flex-col text-slate-800">
                     @csrf
                     <input type="text" name="catagory" id="name" class="w-[20rem] mb-2"><br>
                     <input type="submit" value="Save" class="rounded bg-sky-500 p-1 text-white font-bold w-[10rem] hover:bg-sky-400  ">
                 </form>
             </div>


         </div>
     </section>
     <section id="category-update-container" class="absolute scale-[0]">
         <div class="w-[60vw] h-[80vh] text-white  rounded bg-slate-800 flex  flex-col " id="categoryUpdate">

             <div class="related  w-full h-[5rem] flex justify-end p-5">
                 <button class=" bg-red-500 rounded w-[2.5rem] h-[2.5rem] text-xl font-bold  hover:bg-red-400" onclick="closeForm(this)">X</button>
             </div>

             <h2 class="absolut text-[5rem] text-center ">update Category</h2>

             <div class="relative  w-full h-full flex flex-col justify-center items-center">
                 <form action="{{route('category.store')}}" method="POST" id="category-create-form" class="flex justify-center items-center flex-col text-slate-800">
                     @csrf

                     <input type="text" name="catagory" id="category" placeholder="catagory" class="w-[20rem] mb-2"><br>

                     <input type="submit" value="Save" onclick="send() " class="rounded bg-sky-500 p-1 text-white font-bold w-[10rem] hover:bg-sky-400  ">
                 </form>
             </div>

         </div>
    
     </section>
     <section id="category-delete-container" class="absolute scale-[0]">
         <div class="w-[60vw] h-[30vh] text-black  rounded bg-red-500 flex  flex-col " id="itemCategory">


             <h2 class="absolut text-[2rem] text-center mt-4">Are you sure you want to remove this Category</h2>
             <h3 class="text-center text-xl">Item Name: <span id="itemName"></span></h3>

             <div class="relative  w-full h-full flex  justify-center items-center gap-1">
                 <form action="" method="post" id="delete-category-form">
                     @csrf
                     @method('DELETE')
                    
                     <input type="submit" value="Yes,remove this Category" class="border rounded p-1 hover:bg-red-800 hover:curser-pointer">
                 </form>
                 <button class="border rounded p-1 hover:bg-green-500 w-[5rem]" onclick="closeForm(this)">No</button>
             </div>

         </div>


     </section>

 </section>

 <script>
     function createCategory() {
         const component = document.getElementById('category-create-container');
         component.classList.replace('scale-[0]', 'scale-[100%]');
         component.classList.add('transition');
         component.classList.add('duration-150');
         component.classList.add('ease-in');
         console.log("item create")
     }

     function showCategory() {
         const item = document.getElementById('items');
         const category = document.getElementById('categories');
         item.classList.replace('flex', 'hidden');
         category.classList.replace('hidden', 'flex');

     }

     function closeForm(button) {
         console.log('done')
         $component = button.parentElement.parentElement.parentElement;

         $component.classList.replace('scale-[100%]', 'scale-[0]');
         $component.classList.add('transition');
         $component.classList.add('duration-150');
         $component.classList.add('ease-out');
     }

     function updateCategory(button) {

         const fromContainer = document.getElementById('category-update-container');
         fromContainer.classList.replace('scale-[0]', 'scale-[100%]');
         fromContainer.classList.add('transition');
         fromContainer.classList.add('duration-150');
         fromContainer.classList.add('ease-in');

         let data = button.parentElement.parentElement;
         let id = data.children[0].innerText;
         let name = data.children[1].innerText;
         console.log(name);
         const form = document.getElementById('update-category-form');
         document.getElementById('category').value = name;
         form.action = "/category/" + id;
     }

     function removeCategory(button) {

        const fromContainer = document.getElementById('category-delete-container');
         fromContainer.classList.replace('scale-[0]', 'scale-[100%]');
         fromContainer.classList.add('transition');
         fromContainer.classList.add('duration-150');
         fromContainer.classList.add('ease-in');

         let data = button.parentElement.parentElement;
         let id = data.children[0].innerText;
         let name = data.children[1].innerText;
         
         const form = document.getElementById('delete-category-form');
         document.getElementById('itemName').innerText = name;
         console.log("Item Name: "+document.getElementById('itemName').innerText);
         form.action = "/category/" + id;
     }
 </script>