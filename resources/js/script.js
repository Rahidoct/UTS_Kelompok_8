function logout() {
    $.ajax({
        type: "POST",
        url: "{{ route('logout') }}",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            // Redirect to login page
            window.location.href = "{{ route('login') }}";
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error(textStatus + ": " + errorThrown);
        }
    });
}