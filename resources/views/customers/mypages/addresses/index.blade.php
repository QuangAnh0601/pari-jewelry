@extends('customers.layouts.layout')

@section('content')
    <x-title></x-title>
    <!-- my account section start -->
    <section class="my__account--section section--padding">
        <div class="container">
            <div class="my__account--section__inner border-radius-10 d-flex">
                <x-customers.sidebar :customer="$customer"></x-customers.sidebar>
                <div class="account__wrapper">
                    <div class="account__content">
                        <h2 class="account__content--title h3 mb-20">Addresses</h2>
                        <a href="/customer/address/edit" class="new__address--btn primary__btn mb-25" type="button">Add a new address</a>
                        @if(session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->has('permission'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $errors->first('permission') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="account__table--area">
                            <table class="account__table">
                                <thead class="account__table--header">
                                    <tr class="account__table--header__child">
                                        <th class="account__table--header__child--items">Full Name</th>
                                        <th class="account__table--header__child--items">Phone Number</th>
                                        <th class="account__table--header__child--items">Address</th>
                                        <th class="account__table--header__child--items">Is Default</th>
                                        <th class="account__table--header__child--items">Tools</th> 	 	
                                    </tr>
                                </thead>
                                <tbody class="account__table--body mobile__none">
                                    @foreach ($customer->addresses as $address)
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">{{ $address->full_name }}</td>
                                            <td class="account__table--body__child--items">{{ $address->phone_number }}</td>
                                            <td class="account__table--body__child--items">{{ $address->address }}, {{ $address->ward }}, {{ $address->district }}, {{ $address->city }}</td>
                                            <td class="account__table--body__child--items">{{ $address->is_default }}</td>
                                            <td class="account__table--body__child--items">
                                                <a href="/customer/address/edit/{{$address->id}}">
                                                    <span class="badge bg-success"><i class="fas fa-edit"></i></span>
                                                </a>
                                                <a class="badge bg-danger" href="javascript:void(0)"
                                                    onclick="if(confirm('Are you sure to delete this item ?'))
                                                                    document.getElementById('destroy-form[{{$address->id}}]').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                                <form id="destroy-form[{{$address->id}}]" action="/customer/address/delete/{{$address->id}}" method="POST" class="d-none">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody class="account__table--body mobile__block">
                                    @foreach ($customer->addresses as $address)
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">
                                                <strong>Full Name</strong>
                                                <span>{{ $address->full_name }}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Phone Number</strong>
                                                <span>{{ $address->phone_number }}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Address</strong>
                                                <span>{{ $address->address }}, {{ $address->ward }}, {{ $address->district }}, {{ $address->city }}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Is Default</strong>
                                                <span>{{ $address->is_default }}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Tools</strong>
                                                <span>
                                                    <a href="/customer/address/edit/{{$address->id}}">
                                                        <span class="badge bg-success"><i class="fas fa-edit"></i></span>
                                                    </a>
                                                    <a class="badge bg-danger" href="javascript:void(0)"
                                                        onclick="if(confirm('Are you sure to delete this item ?'))
                                                                        document.getElementById('destroy-form[{{$address->id}}]').submit();">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
    
                                                    <form id="destroy-form[{{$address->id}}]" action="/customer/address/delete/{{$address->id}}" method="POST" class="d-none">
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account section end -->
    <x-service></x-service>
@endsection