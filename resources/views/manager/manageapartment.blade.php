@extends('manager.manager_dashboard')

@section('content')
<div class="container" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center mb-4">Manage Apartment Units</h3>

            <!-- Display allocated apartment and total units -->
            @if($apartment)
                <div class="alert alert-info">
                    <strong>{{ $apartment->PName }}</strong> <br>
                    Total Units: <strong>{{ $totalUnits }}</strong>
                </div>
            @else
                <div class="alert alert-warning">
                    No apartment allocated to you.
                </div>
            @endif

            <!-- Display success message -->
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display error message -->
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('manager.manageunits') }}" enctype="multipart/form-data">

                @csrf
                <div class="form-group mb-4">
                    <label for="room_type">Room Type</label>
                    <select id="room_type" name="room_type" class="form-control">
                        <option value="single_room">Single Room</option>
                        <option value="bedsitter">Bedsitter</option>
                        <option value="one_bedroom">One Bedroom</option>
                        <option value="two_bedroom">Two Bedroom</option>
                        <option value="self_contained">Self Contained</option>
                        <option value="shop">Business Shop</option>
                    </select>
                </div>

                <div id="room-numbers-container" class="mb-4">
                    <label for="room_numbers">Room Numbers</label>
                    <div class="form-group input-group mb-2">
                        <input type="text" id="room_numbers" name="room_numbers[]" class="form-control" placeholder="Enter room numbers">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary add-room-number"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="charges">Charges/Month</label>
                    <input type="number" id="charges" name="charges" class="form-control" placeholder="Charges Per Month">
                </div>

                <div id="room-images-container" class="mb-4">
                    <label for="room_images">Room Images</label>
                    <div class="form-group input-group mb-2">
                        <input type="file" id="room_images" name="room_images_0[]" class="form-control-file">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary add-room-image"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 800px;
    }
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
    .input-group-append button {
        margin-left: 5px;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let roomNumbersContainer = document.getElementById('room-numbers-container');
    let addRoomNumberButton = document.querySelector('.add-room-number');
    let roomImagesContainer = document.getElementById('room-images-container');
    let addRoomImageButton = document.querySelector('.add-room-image');
    let roomImagesCount = 1;

    addRoomNumberButton.addEventListener('click', function () {
        let newRoomNumbersInput = document.createElement('div');
        newRoomNumbersInput.classList.add('form-group', 'input-group', 'mb-2');
        newRoomNumbersInput.innerHTML = `
            <input type="text" name="room_numbers[]" class="form-control" placeholder="Enter room numbers">
            <div class="input-group-append">
                <button type="button" class="btn btn-danger remove-room-number"><i class="fas fa-minus"></i></button>
            </div>
        `;
        roomNumbersContainer.appendChild(newRoomNumbersInput);

        // Add event listener to the remove button
        newRoomNumbersInput.querySelector('.remove-room-number').addEventListener('click', function () {
            this.parentElement.parentElement.remove();
        });
    });

    addRoomImageButton.addEventListener('click', function () {
        let newRoomImagesInput = document.createElement('div');
        newRoomImagesInput.classList.add('form-group', 'input-group', 'mb-2');
        newRoomImagesInput.innerHTML = `
            <input type="file" name="room_images_${roomImagesCount}[]" class="form-control-file">
            <div class="input-group-append">
                <button type="button" class="btn btn-danger remove-room-image"><i class="fas fa-minus"></i></button>
            </div>
        `;
        roomImagesContainer.appendChild(newRoomImagesInput);
        roomImagesCount++;

        // Add event listener to the remove button
        newRoomImagesInput.querySelector('.remove-room-image').addEventListener('click', function () {
            this.parentElement.parentElement.remove();
        });
    });
});
</script>
@endsection
