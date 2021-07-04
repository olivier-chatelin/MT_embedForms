const ingredientsContainer = document.getElementById('ingredients-container');
const form = ingredientsContainer.dataset.prototype;
const addButton = document.getElementById('add-button');
let index = 0;
const createForm = ()=>{
    index ++;
    const regex = /__name__/g;
    const newForm = form.replace(regex,index);
    const li = document.createElement('li');
    console.log(newForm);
    li.innerHTML=newForm;
    ingredientsContainer.appendChild(li);
}

addButton.addEventListener('click',createForm);

