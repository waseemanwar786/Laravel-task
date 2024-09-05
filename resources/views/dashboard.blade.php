<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laravel Task') }}
        </h2>
    </x-slot>
    <div class="d-flex flex-column justify-content-center align-items-center mt-3 position-relative">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
         </div>
     @endif
        <div class="card shadow-lg" style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4 fw-bold">Import CSV/XLS File</h5>
                <form action="{{ route('stock.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="file" class="form-label">Upload CSV/XLS File</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">Import</button>
                    </div>
                    <a href="{{ route('stock.download') }}" class="btn btn-primary position-absolute top-0 end-0 m-3">Download</a>
                </form>
            </div>
        </div>
        <div class="card shadow-lg" style="width: 480px; margin: auto;">
            <div class="card-body">
                @if(!isset($users))
                <h5 class="card-title text-center mb-4 fw-bold" style="font-size: 24px; font-weight: bold; background-color: rgb(24, 7, 182); color: white;">Task 3</h5>
                    <a class="btn btn-primary btn-block" href="{{ route('user.output') }}">Show output</a>
                    <p>Please run user and userAddress Seeder to see the output of this task</p>
                @endif
                <div class="container">
                    <h5 class="card-title text-center mb-4 fw-bold" style="font-size: 24px; font-weight: bold; background-color: red; color: white;">1st Output</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Address Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($users)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->addresses_count }}</td>
                                </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="container">
                        <h5 class="card-title text-center mb-4 fw-bold" style="font-size: 24px; font-weight: bold; background-color: red; color: white;">2nd Output</h5>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($usersWithoutAddresses)
                                @forelse($usersWithoutAddresses as $userwithoutAddress)
                                    <tr>
                                        <td>{{ $userwithoutAddress->id }}</td>
                                        <td>{{ $userwithoutAddress->name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">No users without addresses found.</td>
                                    </tr>
                                @endforelse
                                @endisset
                            </tbody>
                        </table>
                    </div>
                
                </div>
                
                <div class="row align-items-center">
                    <div class="container">
                        <h5 class="card-title text-center mb-4 fw-bold" style="font-size: 24px; font-weight: bold; background-color: red; color: white;">3rd Output</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Address</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($duplicateAddresses)
                                @forelse($duplicateAddresses as $duplicateAddress)
                                    <tr>
                                        <td>{{ $duplicateAddress->address }}</td>
                                        <td>{{ $duplicateAddress->address_count }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">No duplicate addresses found.</td>
                                    </tr>
                                @endforelse
                                @endisset
                            </tbody>
                        </table>
                    </div>              
            </div>
        </div>
        
    </div>
    
</x-app-layout>

