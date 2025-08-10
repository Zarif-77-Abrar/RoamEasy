document.querySelectorAll('.favorite-btn').forEach(button => {
    button.addEventListener('click', function() {
        let destinationId = this.getAttribute('data-id');

        fetch(`/favorites/toggle/${destinationId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'added') {
                this.classList.add('favorited');
                this.textContent = '★ Remove Favorite';
            } else {
                this.classList.remove('favorited');
                this.textContent = '☆ Add Favorite';
            }
        });
    });
});
