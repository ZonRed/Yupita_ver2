@extends('layouts.admin')

@section('title', 'Kasir')

@section('content')

    <!-- Checkout Section -->
    <h6 class="text-uppercase mb-0 mt-5">Check Out</h6>
    <hr />
    <div class="card">
        <div class="table-responsive">
            <div class="card-body">
                <a class="btn btn-primary mb-3" href="javascript:void(0)" id="createNewCheckout">
                    <i class="fa-regular fa-square-plus"></i> Add item
                </a>
                <form id="checkoutForm" action="{{ route('admin.kasir.store') }}" method="POST">
                    @csrf
                    <table class="table table-bordered" id="checkoutTable">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="checkoutItems">
                            <!-- Dynamically populated checkout items -->
                        </tbody>
                    </table>
                    <div class="form-group mt-3">
                        <label for="pembayaranKasir">Pembayaran</label>
                        <input type="number" id="pembayaranKasir" class="form-control"
                            placeholder="Masukkan jumlah pembayaran" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="kembalianKasir">Kembalian</label>
                        <input type="text" id="kembalianKasir" class="form-control" readonly>
                    </div>
                    <!-- tombol checkout -->
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cash-register"></i>
                            Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Transaction History Section -->
    <h6 class="text-uppercase mb-0 mt-5">History Transaksi</h6>
    <hr />
    <div class="card">
        <div class="table-responsive">
            <div class="card-body">
                <table id="transactionsTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Pembayaran</th>
                            <th>Kembalian</th>
                            <th>User</th>
                            <th>Tanggal (WIB)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DataTable will populate this area -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Monthly Earnings Table Section -->
    <h6 class="text-uppercase mb-0 mt-5">Penghasilan Bulanan</h6>
    <hr />
    <div class="card">
        <div class="table-responsive">
            <div class="card-body">
                <table id="monthlyEarningsTable" class="table table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Bulan - Tahun</th>
                        <th>Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DataTable will populate this area -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include Modal Files -->
    @include('admin.kasir.create')
    @include('admin.kasir.delete')

@endsection

@section('js')
    <script>
        // Initialize the items array from localStorage or an empty array
        let checkoutItems = JSON.parse(localStorage.getItem('checkoutItems')) || [];

        $(document).ready(function() {
            renderCheckoutItems(); // Render items on page load

            // Initialize DataTable for transaction history
            const transactionTable = $('#transactionsTable').DataTable({
                "order": [
                    [0, "asc"]
                ], // Order by first column (No)
                "paging": true,
                "searching": true,
                "lengthChange": true,
                "ajax": {
                    "url": "{{ route('admin.kasir.history') }}", // Route for fetching history
                    "dataSrc": ""
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    }, // No
                    {
                        "data": "item_kasir",
                        "render": function(data) {
                            const items = JSON.parse(data);
                            return `<ul class="list-unstyled">${items.map(item =>
                    `<li>&bull; ${item.item} - Jumlah: ${item.jumlah} - Harga: Rp. ${item.harga.toLocaleString('id-ID')}</li>`
                ).join('')}</ul>`;
                        }
                    },
                    {
                        "data": "jumlah_kasir"
                    },
                    {
                        "data": "total_kasir",
                        "render": function(data) {
                            const total = Number(data);
                            return `Rp. ${isNaN(total) ? '0' : total.toLocaleString('id-ID')}`;
                        }
                    },
                    {
                        "data": "pembayaran_kasir",
                        "render": function(data) {
                            return `Rp. ${Number(data).toLocaleString('id-ID')}`;
                        }
                    },
                    {
                        "data": "kembalian_kasir",
                        "render": function(data) {
                            return `Rp. ${Number(data).toLocaleString('id-ID')}`;
                        }
                    },
                    {
                        "data": "user.name"
                    },
                    {
                        "data": "created_at",
                        "render": function(data) {
                            return new Date(data).toLocaleString('id-ID', {
                                timeZone: 'Asia/Jakarta'
                            });
                        }
                    },
                    {
                        "data": null,
                        "render": function(data) {
                            return `<a href="{{ url('admin/kasir/print') }}/${data.id}" class="btn btn-dark btn-sm" target="_blank"><i class="fas fa-print"></i> Print</a>`;
                        }
                    }
                ]
            });

            // Function to fetch history without reload
            function fetchHistory() {
                transactionTable.ajax.reload(null, false); // user paging is not reset on reload
            }

            // Set interval to fetch data every 5 seconds
            setInterval(fetchHistory, 5000);

            // Initialize DataTable for monthly earnings
            const monthlyEarningsTable = $('#monthlyEarningsTable').DataTable({
                "order": [
                    [0, "asc"] // Order by month (the second column)
                ],
                "paging": true,
                "searching": true,
                "lengthChange": true,
                "ajax": {
                    "url": "{{ route('admin.kasir.monthly-earnings') }}",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + 1; // Row number
                        }
                    },
                    {
                        "data": "month",
                        "render": function(data, type, row) {
                            const monthName = new Date(new Date().setMonth(data - 1))
                                .toLocaleString('default', {
                                    month: 'long'
                                });
                            return `${monthName} - ${row.year}`; // Convert month number to month name
                        }
                    },
                    {
                        "data": "total",
                        "render": function(data) {
                            const total = Number(data);
                            return `Rp. ${isNaN(total) ? '0' : total.toLocaleString('id-ID')}`;
                        }
                    }
                ]
            });

            // Function to fetch monthly earnings without reload
            function fetchMonthlyEarnings() {
                monthlyEarningsTable.ajax.reload(null, false); // User paging is not reset on reload
            }

            // Set interval to fetch data every 5 seconds
            setInterval(fetchMonthlyEarnings, 5000);

            $('#createNewCheckout').on('click', function() {
                $('#createItemModal').modal('show');
            });

            // Save new item to checkout
            $('#saveNewItem').on('click', function() {
                const itemName = $('#createItemName').val();
                const itemPrice = parseFloat($('#createItemPrice').val());
                const itemQuantity = parseInt($('#createItemQuantity').val());

                // Check if item already exists in checkoutItems
                const existingItemIndex = checkoutItems.findIndex(item => item.itemName === itemName);
                if (existingItemIndex !== -1) {
                    checkoutItems[existingItemIndex].itemQuantity +=
                        itemQuantity; // Increase quantity if item already exists
                } else {
                    checkoutItems.push({
                        itemName,
                        itemPrice,
                        itemQuantity
                    });
                }

                localStorage.setItem('checkoutItems', JSON.stringify(
                    checkoutItems)); // Save to localStorage
                $('#createItemModal').modal('hide');
                renderCheckoutItems();
            });

            function renderCheckoutItems() {
                $('#checkoutItems').empty();
                checkoutItems.forEach((item, index) => {
                    $('#checkoutItems').append(`
            <tr>
                <td>${item.itemName}</td>
                <td>${'Rp. ' + item.itemPrice.toLocaleString('id-ID')}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-danger btn-sm decreaseQuantity" data-index="${index}" ${item.itemQuantity === 0 ? 'disabled' : ''}>-</button>
                        <input type="number" class="form-control quantityInput mx-2" value="${item.itemQuantity}" min="0" data-index="${index}" style="width: 80px; text-align: center;">
                        <button class="btn btn-success btn-sm increaseQuantity" data-index="${index}">+</button>
                    </div>
                </td>
                <td>
                    <div class="d-flex">
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm me-2 editCheckout" data-index="${index}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm deleteCheckout" data-index="${index}"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </td>
            </tr>
        `);
                });

                // Update quantity in localStorage on input change
                $(document).on('change', '.quantityInput', function() {
                    const index = $(this).data('index');
                    const newValue = Math.max(0, parseInt($(this).val())); // Prevent negative values
                    if (checkoutItems[index].itemQuantity !== newValue) {
                        checkoutItems[index].itemQuantity = newValue;
                        localStorage.setItem('checkoutItems', JSON.stringify(
                            checkoutItems)); // Save to localStorage
                        renderCheckoutItems(); // Update the display only when necessary
                    }
                });
            }

            // Event listener untuk tombol +
            $(document).on('click', '.increaseQuantity', function() {
                const index = $(this).data('index');
                checkoutItems[index].itemQuantity += 1; // Tambah 1 pada jumlah
                localStorage.setItem('checkoutItems', JSON.stringify(
                    checkoutItems)); // Simpan ke localStorage
                renderCheckoutItems(); // Render ulang
            });

            // Event listener for the minus button
            $(document).on('click', '.decreaseQuantity', function() {
                const index = $(this).data('index');
                if (checkoutItems[index].itemQuantity > 0) {
                    checkoutItems[index].itemQuantity -= 1; // Decrease quantity
                    localStorage.setItem('checkoutItems', JSON.stringify(
                        checkoutItems)); // Save to localStorage
                    renderCheckoutItems(); // Re-render the items
                }
            });

            $(document).on('click', '.editCheckout', function() {
                const index = $(this).data('index');
                const item = checkoutItems[index];
                $('#editItemIndex').val(index);
                $('#editItemName').val(item.itemName);
                $('#editItemPrice').val(item.itemPrice);
                $('#editItemQuantity').val(item.itemQuantity);
                $('#editItemModal').modal('show');
            });

            $('#updateItem').on('click', function() {
                const index = $('#editItemIndex').val();
                checkoutItems[index].itemName = $('#editItemName').val();
                checkoutItems[index].itemPrice = parseFloat($('#editItemPrice').val());
                checkoutItems[index].itemQuantity = parseInt($('#editItemQuantity').val());
                localStorage.setItem('checkoutItems', JSON.stringify(
                    checkoutItems)); // Save to localStorage
                $('#editItemModal').modal('hide');
                renderCheckoutItems();
            });

            $(document).on('click', '.deleteCheckout', function() {
                const index = $(this).data('index');
                $('#deleteItemModal').modal('show');

                $('#confirmDeleteItem').off('click').on('click', function() {
                    checkoutItems.splice(index, 1);
                    localStorage.setItem('checkoutItems', JSON.stringify(
                        checkoutItems)); // Save to localStorage
                    $('#deleteItemModal').modal('hide');
                    renderCheckoutItems();
                });
            });

            $('#checkoutForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const items = {};
                const prices = {};
                let hasItems = false; // Flag to check if there are items to checkout
                const pembayaran = parseFloat($('#pembayaranKasir').val()); // Get payment amount
                const kembalian = parseFloat($('#kembalianKasir').val()); // Get change amount
                const totalHarga = checkoutItems.reduce((acc, item) => acc + (item.itemPrice * item
                    .itemQuantity), 0);

                // Cek jika pembayaran cukup
                if (pembayaran < totalHarga) {
                    toastr.warning('Pembayaran kurang dari total harga.', 'Warning!', {
                        "positionClass": "toast-top-right",
                        "timeOut": "3000",
                        "progressBar": true
                    });
                    return; // Stop the checkout process if payment is insufficient
                }

                // Change button to "Sending.."
                const checkoutButton = $('#checkoutForm button[type="submit"]');
                checkoutButton.html('<i class="fa-solid fa-cash-register"></i> Sending..').prop('disabled',
                    true);

                $.ajax({
                    url: "{{ route('admin.kasir.store') }}",
                    type: 'POST',
                    data: {
                        items: JSON.stringify(items), // Array of items
                        prices: JSON.stringify(prices), // Array of prices
                        pembayaran: pembayaran, // Amount paid
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        toastr.success(response.success, 'Sukses!', {
                            "positionClass": "toast-top-right",
                            "timeOut": "3000",
                            "progressBar": true,
                            "preventDuplicates": true
                        });

                        // Reload the DataTable to show the updated history
                        transactionTable.ajax.reload();

                        // Reset quantities in checkout items to 0
                        checkoutItems.forEach(item => {
                            item.itemQuantity = 0; // Reset quantity
                        });
                        localStorage.setItem('checkoutItems', JSON.stringify(
                            checkoutItems)); // Save updated quantities to localStorage
                        renderCheckoutItems(); // Re-render the checkout items

                        // Reset button to original state after successful checkout
                        checkoutButton.html(
                            '<i class="fa-solid fa-cash-register"></i> Checkout').prop(
                            'disabled', false);
                    },
                    error: function(xhr) {
                        toastr.error('Something went wrong: ' + xhr.responseText, 'Error!', {
                            "positionClass": "toast-top-right",
                            "timeOut": "3000",
                            "progressBar": true
                        });
                        // Reset button to original state on error
                        checkoutButton.html(
                            '<i class="fa-solid fa-cash-register"></i> Checkout').prop(
                            'disabled', false);
                    }
                });
            });
        });
        $('#pembayaranKasir').on('input', function() {
            const pembayaran = parseFloat($(this).val());
            const totalHarga = checkoutItems.reduce((acc, item) => acc + (item.itemPrice * item.itemQuantity), 0);

            if (pembayaran >= totalHarga) {
                const kembalian = pembayaran - totalHarga;
                $('#kembalianKasir').val(kembalian.toLocaleString('id-ID'));
            } else {
                $('#kembalianKasir').val('');
            }
        });

        // Debounce function for input events
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }
    </script>
@endsection
