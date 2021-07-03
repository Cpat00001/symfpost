//alert("loaded JS file");
// target element from tabela -> button with Delete data-post-id
const table_posts = document.getElementById("tabela");
console.log(table_posts);

table_posts.addEventListener("click", (evt) => {
    // alert("clicked");
    if(evt.target.className === "btn btn-danger delete-post"){
        // alert('button delete')
        // ask if you are sure to delete/confirm operation
        if(confirm("Are you sure you want to delete??")){
             
            const post_id = evt.target.dataset.postId; 
            console.log(post_id);
            // fetch() request to symfony URI with delete method + reload current page after deletion
            fetch(`/symfpost/public/posts/delete/${post_id}` , { method: 'DELETE' })
            .then(response => window.location.reload());
        }
    }
})