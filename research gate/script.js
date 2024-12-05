document.addEventListener('DOMContentLoaded', () => {
    const createPostTextarea = document.querySelector('.create-post textarea');
    const postButton = document.querySelector('.create-post button:last-child');
    const feedPosts = document.querySelector('.feed-posts');

    postButton.addEventListener('click', () => {
        const postContent = createPostTextarea.value.trim();
        
        if (postContent) {
            const newPost = document.createElement('div');
            newPost.classList.add('post');
            newPost.innerHTML = `
                <h4>New Research Insight</h4>
                <p>${postContent}</p>
                <div class='post-interactions'> 
                    <span>0 Likes</span>
                    <span>0 Comments</span>
                </div>
            `;
            
            feedPosts.insertBefore(newPost, feedPosts.firstChild);
            createPostTextarea.value = '';
        }
    });

    const connectButtons = document.querySelectorAll('.recommended-connections .connection button');
    connectButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const connectionName = e.target.previousElementSibling.textContent;
            alert(`Connection request sent to ${connectionName}`);
            e.target.textContent = 'Request Sent';
            e.target.disabled = true;
        });
    });
});