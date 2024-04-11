const closed = document.querySelectorAll('.close');
closed.forEach((e) => {
    e.addEventListener('click',()=> {
        document.querySelector('.alert').style.display = 'none'
        console.log('yo!')
    })
});