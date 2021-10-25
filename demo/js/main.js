const btns = document.querySelectorAll('.btn--open');
const modalCreatePost = document.querySelector('.js--modal-create');
// const modalEditPost = document.querySelector('.js--modal-edit');
// const modalContainerEdit = document.querySelector('.js--modal--container-edit');
const modalContainer = document.querySelector('.js--modal--container');

const modalClose = document.querySelector('.js-modal--closebtn');
// const modalCloseEdit = document.querySelector('.js-modal--closebtn-edit');

const textarea = document.querySelector("textarea");
let status = true;
function hideModalCreatePost() {
    modalCreatePost.classList.remove('open');
}

// function hideModalEditPost() {
//     modalEditPost.classList.remove('open');
// }
btns[0].addEventListener('click', function() {
    modalCreatePost.classList.add('open');
});
// for ( let i = 1; i < btns.length;i++ ){
//     btns[i].addEventListener('click', function() {
//         console.log(1);
//         modalEditPost.classList.add('open');
//     });
// }
modalClose.addEventListener('click', hideModalCreatePost);
// modalCloseEdit.addEventListener('click', hideModalEditPost);

modalCreatePost.addEventListener('click', hideModalCreatePost);
modalContainer.addEventListener('click', function(event) {
    event.stopPropagation();
})

modalContainerEdit.addEventListener('click', function(event) {
    event.stopPropagation();
})

textarea.addEventListener('keyup', function(e) {
    let scH = e.target.scrollHeight;
    var size = 20;
    if (scH > 200 ) {
        size = size - 1;
        console.log(size);
        textarea.style.fontSize = `${size}px`;
    } else {
        textarea.style.fontSize = `${size}px`;
    }
});