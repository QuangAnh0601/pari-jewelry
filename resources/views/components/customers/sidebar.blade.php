<style>
    .avatar {
      position: relative;
    }

    .avatar-image {
      opacity: 1;
      display: block;
      width: 100%;
      transition: .5s ease;
      backface-visibility: hidden;
      object-fit: cover;
      border: 2px solid grey;
      border-radius: 100px;
    }
    
    .middle {
      transition: .5s ease;
      opacity: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      cursor: pointer;
    }
    
    .avatar:hover .avatar-image {
      opacity: 0.3;
    }
    
    .avatar:hover .middle {
      opacity: 1;
    }
    
    .avatar-text {
      color: black;
      font-size: 16px;
    }
</style>
<div class="account__left--sidebar">
    <h2 class="account__content--title h3 mb-20">My Profile</h2>
    <div class="avatar mb-5">
        <input type="file" name="iamge" id="image" hidden>
        <img src="{{ asset('img/customer-images/'.$customer->image) }}" class="avatar-image" alt="">
        <div class="middle">
            <div class="avatar-text">Click the text to change Your avatar</div>
        </div>
    </div>
    <ul class="account__menu">
        <li class="account__menu--list {{Request::is('customer/dashboard*') ? 'active' : ''}}"><a href="/customer/dashboard">Dashboard</a></li>
        <li class="account__menu--list {{Request::is('customer/order-history*') ? 'active' : ''}}"><a href="/customer/order-history">Order History</a></li>
        <li class="account__menu--list {{Request::is('customer/address*') ? 'active' : ''}}"><a href="/customer/address">Addresses</a></li>
        <li class="account__menu--list {{Request::is('customer/wish-list*') ? 'active' : ''}}"><a href="/customer/wish-list">Wishlist</a></li>
        <li class="account__menu--list"><a href="{{route('customer.logout')}}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>

<script>
    $(".middle").click(function () { 
        $('#image').click();
    });
    
    $('#image').change(function (e) { 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData()
            formData.append('image', this.files[0]);
            console.log(this.files[0])
            $.ajax({
                type: "post",
                url: "/customer/dashboard/updateAvatar",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    alert(response);
                },
                error: function (error) {
                    console.log(error);
                }
            });  
            if (this.files) {
                var filesAmount = this.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        // $($.parseHTML('<img>')).attr('src', event.target.result).attr('width', 200).attr('class', 'mr-2 mt-3 p-2 border rounded').appendTo(placeToInsertImagePreview);
                        $('.avatar > img').attr('src', event.target.result);
                    }

                    reader.readAsDataURL(this.files[i]);
                }
            }
        });
</script>