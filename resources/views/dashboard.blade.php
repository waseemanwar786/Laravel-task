<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laravel Task') }}
        </h2>
    </x-slot>
    <div class="d-flex flex-column justify-content-center align-items-center mt-3 position-relative">
        <div class="card shadow-lg" style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title text-center mb-4 fw-bold">Import CSV File</h5>
                <form action="{{ route('stock.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="csv_file" class="form-label">Upload CSV File</label>
                        <input type="file" name="csv_file" class="form-control" required>
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
                <h5 class="card-title text-center mb-4 fw-bold">Task 3 Output</h5>
                
                <div class="row align-items-center mb-3">
                    <div class="col-8">
                        <a href="{{ route('user.address.counts') }}" class="btn btn-primary w-100">Show 1st output:</a>
                    </div>
                    @if(isset($users))
                    <div class="col-4 text-end">
                        <h3 class="mb-0 text-dark" style="font-size: 30px">{{ $users->count() ?? '' }}</h3>
                    </div>
                    @endif
                </div>
                
                
                <div class="row align-items-center mb-3">
                    <div class="col-8">
                        <a href="{{ route('users.without.addresses') }}" class="btn btn-primary w-100">Show 2nd output:</a>
                    </div>
                    @if(isset($usersWithoutAddresses))
                    <div class="col-4 text-end">
                        <h3 class="mb-0 text-dark" style="font-size: 30px">{{ $usersWithoutAddresses->count() ?? 'N/A' }}</h3>
                    </div>
                    @endif
                </div>
                
                <div class="row align-items-center">
                    <div class="col-8">
                        <a href="{{ route('duplicate.addresses') }}" class="btn btn-primary w-100">Show 3rd output:</a>
                    </div>
                    @if(isset($duplicateAddresses))
                    <div class="col-4 text-end">
                        <h3 class="mb-0 text-dark" style="font-size: 30px">{{ $duplicateAddresses->count() ?? 'N/A' }}</h3>
                    </div>
                    @endif
                </div>
                
            </div>
        </div>
        
    </div>
    
</x-app-layout>
