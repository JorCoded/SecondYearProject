<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>HotelPro · Management Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f1f5f9;
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            padding: 32px 40px;
            color: #0a1e2f;
        }

        /* main dashboard card container */
        .dashboard {
            max-width: 1440px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 28px;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            transition: all 0.2s ease;
        }

        /* inner spacing */
        .dashboard-inner {
            padding: 28px 32px 40px 32px;
        }

        /* header + stats row */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            margin-bottom: 32px;
            gap: 20px;
        }

        .logo-area h1 {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.3px;
            background: linear-gradient(135deg, #1B2B40 0%, #2C4C6E 100%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 4px;
        }

        .logo-area span {
            font-size: 13px;
            font-weight: 500;
            color: #5b6e8c;
            letter-spacing: 0.2px;
        }

        /* Tab Navigation */
        .tab-navigation {
            display: flex;
            gap: 8px;
            margin-bottom: 28px;
            background: #F8FAFE;
            border-radius: 16px;
            padding: 6px;
            overflow-x: auto;
        }

        .tab-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border: none;
            background: transparent;
            font-size: 14px;
            font-weight: 500;
            color: #5c6f8f;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .tab-btn:hover {
            background: rgba(27, 43, 64, 0.05);
            color: #1B2B40;
        }

        .tab-btn.active {
            background: #ffffff;
            color: #1B2B40;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .tab-btn i {
            font-size: 14px;
        }

        /* stats grid */
        .stats-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            background: #F8FAFE;
            border-radius: 24px;
            padding: 8px 16px 8px 16px;
            backdrop-filter: blur(2px);
        }

        .stat-card {
            background: transparent;
            min-width: 90px;
            text-align: left;
        }

        .stat-label {
            font-size: 14px;
            font-weight: 500;
            color: #5c6f8f;
            letter-spacing: 0.3px;
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 34px;
            font-weight: 700;
            color: #0F2B3F;
            line-height: 1.1;
            letter-spacing: -0.5px;
        }

        .stat-percent {
            font-size: 15px;
            font-weight: 600;
            color: #1e7e6c;
            background: #e0f2ef;
            padding: 2px 8px;
            border-radius: 40px;
            display: inline-block;
            margin-left: 8px;
            vertical-align: middle;
        }

        /* dual panel layout */
        .data-workspace {
            margin-top: 24px;
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
        }

        /* left panel — filters block */
        .meta-panel {
            flex: 1.1;
            min-width: 240px;
            background: #FFFFFF;
            border-radius: 24px;
            border: 1px solid #eef2f8;
            padding: 18px 0 12px 0;
            align-self: start;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }

        .section-title {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #5c6e8a;
            padding: 0 20px 12px 20px;
            border-bottom: 1px solid #edf2f7;
            margin-bottom: 12px;
        }

        .filters-section {
            padding: 0 20px;
            margin-top: 8px;
        }

        .filter-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            font-size: 14px;
            font-weight: 500;
            color: #1f344b;
            border-bottom: 1px solid #f0f4fa;
        }

        .filter-row:last-child {
            border-bottom: none;
        }

        .filter-row i {
            width: 20px;
            color: #6e85a8;
            font-size: 13px;
        }

        .filter-label {
            flex: 1;
        }

        /* right table panel */
        .table-panel {
            flex: 3.2;
            min-width: 580px;
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #eef2f8;
            overflow-x: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .employees-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            min-width: 680px;
        }

        .employees-table th {
            text-align: left;
            padding: 18px 16px;
            background-color: #FBFDFF;
            font-weight: 600;
            color: #2b3f5c;
            border-bottom: 1px solid #e9edf2;
            font-size: 13px;
            letter-spacing: 0.2px;
        }

        .employees-table td {
            padding: 15px 16px;
            border-bottom: 1px solid #f0f4fa;
            color: #1e2f42;
            font-weight: 500;
        }

        .employees-table tr:last-child td {
            border-bottom: none;
        }

        .employees-table tr:hover td {
            background-color: #F9FCFE;
        }

        /* badge styles */
        .badge-active {
            background: #e1f7f0;
            color: #1d7a64;
            padding: 4px 10px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-vip {
            background: #fff3cd;
            color: #856404;
            padding: 4px 10px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-available {
            background: #d1fae5;
            color: #065f46;
            padding: 4px 10px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-occupied {
            background: #eef2ff;
            color: #2c5282;
            padding: 4px 10px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-maintenance {
            background: #fee2e2;
            color: #b91c1c;
            padding: 4px 10px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-closed {
            background: #fee2e2;
            color: #b91c1c;
            padding: 4px 10px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-expired {
            background: #fee2e2;
            color: #b91c1c;
            padding: 4px 10px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-open {
            background: #e1f7f0;
            color: #1d7a64;
            padding: 4px 10px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .action-btn {
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            cursor: pointer;
            margin-right: 6px;
            color: white;
        }

        .btn-view {
            background: #4299e1;
        }

        .btn-edit {
            background: #38a169;
        }

        .action-btn:hover {
            opacity: 0.9;
        }

        .global-search-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 22px;
            align-items: center;
            gap: 12px;
        }

        .search-wrapper {
            display: flex;
            align-items: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 60px;
            padding: 6px 16px;
            gap: 8px;
        }

        .search-wrapper i {
            color: #8ba0bc;
            font-size: 14px;
        }

        .search-wrapper input {
            border: none;
            background: transparent;
            font-size: 14px;
            padding: 6px 0;
            width: 200px;
            outline: none;
            font-family: 'Inter', sans-serif;
        }

        .search-wrapper input::placeholder {
            color: #a9bbd4;
            font-weight: 400;
        }

        .divider-light {
            margin: 8px 0;
        }

        .info-tag {
            background: #F0F4FA;
            padding: 4px 10px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .revenue-text {
            color: #1f4f3c;
            font-weight: 600;
        }

        .rating-text {
            color: #f59e0b;
            font-weight: 600;
        }

        .promo-badge {
            background: #eef2ff;
            color: #2c5282;
            padding: 4px 10px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* responsiveness */
        @media (max-width: 980px) {
            body {
                padding: 20px;
            }

            .stats-grid {
                width: 100%;
            }

            .table-panel {
                min-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <div class="dashboard-inner">
            <!-- Header + stats row -->
            <div class="top-header">
                <div class="logo-area">
                    <h1>HotelPro</h1>
                    <span>Hotel Management System</span>
                </div>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-label">Total Hotels</div>
                        <div class="stat-value">{{ $stats['totalHotels'] }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Occupancy Rate</div>
                        <div class="stat-value">{{ $stats['occupancyRate'] }}<span class="stat-percent">%</span></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Revenue</div>
                        <div class="stat-value">${{ number_format($stats['revenue']) }}</div>
                    </div>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="tab-navigation">
                <a href="#"><button class="tab-btn active" onclick="switchTab('customers')" id="tab-customers">
                    <i class="fas fa-users"></i> Customers
                </button></a>
                <button class="tab-btn" onclick="switchTab('staff')" id="tab-staff">
                    <i class="fas fa-user-tie"></i> Staff
                </button>
                <button class="tab-btn" onclick="switchTab('hotels')" id="tab-hotels">
                    <i class="fas fa-hotel"></i> Hotels
                </button>
                <button class="tab-btn" onclick="switchTab('rooms')" id="tab-rooms">
                    <i class="fas fa-bed"></i> Rooms
                </button>
                <button class="tab-btn" onclick="switchTab('room-types')" id="tab-room-types">
                    <i class="fas fa-building"></i> Room Types
                </button>
                <button class="tab-btn" onclick="switchTab('promotions')" id="tab-promotions">
                    <i class="fas fa-tags"></i> Promotions
                </button>
            </div>

            <!-- Global search -->
            <div class="global-search-bar">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search..." id="searchInput">
                </div>
            </div>

            <!-- Data workspace with tab content -->
            <div class="data-workspace">
                <!-- LEFT SIDE: Filters and Actions -->
                <div class="meta-panel">
                    <div class="section-title">
                        <i class="fas fa-sliders-h" style="margin-right: 6px;"></i> Filters
                    </div>
                    <div class="filters-section" id="filters-content">
                        <!-- Filters will be populated based on active tab -->
                    </div>

                    <div class="divider-light"></div>
                    <div class="section-title" style="margin-top: 6px;">
                        <i class="fas fa-cog" style="margin-right: 8px;"></i> Actions
                    </div>
                    <div class="filters-section">
                        <div class="filter-row" style="cursor: pointer;" onclick="addNewRecord()">
                            <i class="fas fa-plus-circle" style="color: #2c7a7b;"></i>
                            <span class="filter-label"><a href=""
                                    style="text-decoration: none; color: #1f344b;">Add New</a></span>
                        </div>
                        <div class="filter-row" style="cursor: pointer;" onclick="exportData()">
                            <i class="fas fa-download" style="color: #38a169;"></i>
                            <span class="filter-label">Export Data</span>
                        </div>
                        <div class="filter-row" style="cursor: pointer;" onclick="refreshData()">
                            <i class="fas fa-sync" style="color: #4299e1;"></i>
                            <span class="filter-label">Refresh</span>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE: Data Tables for each tab -->
                <div class="table-panel">
                    <!-- Customers Tab -->
                    <div id="tab-content-customers" class="tab-content active">
                        <table class="employees-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Bookings</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                    <tr>
                                        <td><strong>{{ $customer->firstname }} {{ $customer->lastname }}</strong></td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phoneNumber }}</td>
                                        <td><span class="info-tag">5</span></td>
                                        <td><span class="badge-active">Active</span></td>
                                        <td>
                                            <button class="action-btn btn-view"
                                                onclick="viewDetails('customer', {{ $customer->id }})">View</button>
                                            <button class="action-btn btn-edit"
                                                onclick="editRecord('customer', {{ $customer->id }})">Edit</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; padding: 40px;">No customers found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Staff Tab -->
                    <div id="tab-content-staff" class="tab-content">
                        <table class="employees-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($staff as $staffMember)
                                    <tr>
                                        <td><strong>{{ $staffMember->firstname }}
                                                {{ $staffMember->lastname }}</strong></td>
                                        <td>{{ $staffMember->is_admin ? 'Admin' : 'Staff' }}</td>
                                        <td>{{ $staffMember->email }}</td>
                                        <td>{{ $staffMember->phoneNumber }}</td>
                                        <td><span class="badge-active">Active</span></td>
                                        <td>
                                            <button class="action-btn btn-view"
                                                onclick="viewDetails('staff', {{ $staffMember->id }})">View</button>
                                            <button class="action-btn btn-edit"
                                                onclick="editRecord('staff', {{ $staffMember->id }})">Edit</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; padding: 40px;">No staff members
                                            found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Hotels Tab -->
                    <div id="tab-content-hotels" class="tab-content">
                        <table class="employees-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Rooms</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($hotels as $hotel)
                                    <tr>
                                        <td><strong>{{ $hotel->hotel_name }}</strong></td>
                                        <td>{{ $hotel->location }}</td>
                                        <td><span class="info-tag">{{ $hotel->rooms_count ?? 'N/A' }}</span></td>
                                        <td>{{ $hotel->phoneNumber }}</td>
                                        <td><span class="badge-open">Open</span></td>
                                        <td>
                                            <button class="action-btn btn-view"
                                                onclick="viewDetails('hotel', {{ $hotel->id }})">View</button>
                                            <button class="action-btn btn-edit"
                                                onclick="editRecord('hotel', {{ $hotel->id }})">Edit</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; padding: 40px;">No hotels found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Rooms Tab -->
                    <div id="tab-content-rooms" class="tab-content">
                        <table class="employees-table">
                            <thead>
                                <tr>
                                    <th>Room #</th>
                                    <th>Type</th>
                                    <th>Hotel</th>
                                    <th>Floor</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rooms as $room)
                                    <tr>
                                        <td><strong>{{ $room->roomNumber }}</strong></td>
                                        <td>{{ $room->roomType ? $room->roomType->name : 'N/A' }}</td>
                                        <td><span
                                                class="info-tag">{{ $room->hotel ? $room->hotel->hotel_name : 'N/A' }}</span>
                                        </td>
                                        <td><span class="info-tag">Floor {{ $room->floor }}</span></td>
                                        <td>
                                            @if ($room->isAvailable)
                                                <span class="badge-available">Available</span>
                                            @else
                                                <span class="badge-occupied">Occupied</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="action-btn btn-view"
                                                onclick="viewDetails('room', {{ $room->id }})">View</button>
                                            <button class="action-btn btn-edit"
                                                onclick="editRecord('room', {{ $room->id }})">Edit</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; padding: 40px;">No rooms found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Room Types Tab -->
                    <div id="tab-content-room-types" class="tab-content">
                        <table class="employees-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Count</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roomTypes as $roomType)
                                    <tr>
                                        <td><strong>{{ $roomType->name }}</strong></td>
                                        <td>{{ $roomType->description ?? 'No description' }}</td>
                                        <td><span class="info-tag">{{ $roomType->rooms_count ?? 'N/A' }} rooms</span>
                                        </td>
                                        <td>
                                            <button class="action-btn btn-view"
                                                onclick="viewDetails('room-type', {{ $roomType->id }})">View</button>
                                            <button class="action-btn btn-edit"
                                                onclick="editRecord('room-type', {{ $roomType->id }})">Edit</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center; padding: 40px;">No room types
                                            found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Promotions Tab -->
                    <div id="tab-content-promotions" class="tab-content">
                        <table class="employees-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Discount</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($promotions as $promotion)
                                    <tr>
                                        <td><strong>{{ $promotion->name }}</strong></td>
                                        <td>{{ ucfirst($promotion->type ?? 'percentage') }}</td>
                                        <td><span class="promo-badge"><i class="fas fa-tag"
                                                    style="margin-right:4px;"></i>{{ $promotion->discount_value }}{{ $promotion->type == 'percentage' ? '%' : '' }}</span>
                                        </td>
                                        <td>{{ $promotion->starts_at ? \Carbon\Carbon::parse($promotion->starts_at)->format('Y-m-d') : 'N/A' }}
                                        </td>
                                        <td>{{ $promotion->ends_at ? \Carbon\Carbon::parse($promotion->ends_at)->format('Y-m-d') : 'N/A' }}
                                        </td>
                                        <td>
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $startsAt = $promotion->starts_at
                                                    ? \Carbon\Carbon::parse($promotion->starts_at)
                                                    : null;
                                                $endsAt = $promotion->ends_at
                                                    ? \Carbon\Carbon::parse($promotion->ends_at)
                                                    : null;
                                                $isActive = $startsAt && $endsAt && $now->between($startsAt, $endsAt);
                                            @endphp
                                            @if ($isActive)
                                                <span class="badge-active">Active</span>
                                            @else
                                                <span class="badge-expired">Expired</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="action-btn btn-view"
                                                onclick="viewDetails('promotion', {{ $promotion->id }})">View</button>
                                            <button class="action-btn btn-edit"
                                                onclick="editRecord('promotion', {{ $promotion->id }})">Edit</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center; padding: 40px;">No promotions
                                            found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        function switchTab(tabName) {
            // Update tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.getElementById('tab-' + tabName).classList.add('active');

            // Update content visibility
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            document.getElementById('tab-content-' + tabName).classList.add('active');

            // Update filters based on tab
            updateFilters(tabName);
        }

        // Update filters based on active tab
        function updateFilters(tabName) {
            const filtersContent = document.getElementById('filters-content');

            const filters = {
                customers: [{
                        icon: 'fa-user-tag',
                        label: 'Name'
                    },
                    {
                        icon: 'fa-envelope',
                        label: 'Email'
                    },
                    {
                        icon: 'fa-phone',
                        label: 'Phone'
                    },
                ],
                staff: [{
                        icon: 'fa-user-tag',
                        label: 'Name'
                    },
                    {
                        icon: 'fa-briefcase',
                        label: 'Position'
                    },
                    {
                        icon: 'fa-hotel',
                        label: 'Department'
                    },
                    {
                        icon: 'fa-circle',
                        label: 'Status'
                    }
                ],
                hotels: [{
                        icon: 'fa-hotel',
                        label: 'Hotel Name'
                    },
                    {
                        icon: 'fa-map-marker-alt',
                        label: 'Location'
                    },
                    {
                        icon: 'fa-bed',
                        label: 'Rooms'
                    },
                    {
                        icon: 'fa-star',
                        label: 'Rating'
                    }
                ],
                rooms: [{
                        icon: 'fa-bed',
                        label: 'Room Number'
                    },
                    {
                        icon: 'fa-building',
                        label: 'Type'
                    },
                    {
                        icon: 'fa-hotel',
                        label: 'Hotel'
                    },
                    {
                        icon: 'fa-circle',
                        label: 'Status'
                    }
                ],
                'room-types': [{
                        icon: 'fa-building',
                        label: 'Type Name'
                    },
                    {
                        icon: 'fa-bed',
                        label: 'Beds'
                    },
                    {
                        icon: 'fa-users',
                        label: 'Capacity'
                    },
                    {
                        icon: 'fa-dollar-sign',
                        label: 'Price Range'
                    }
                ],
                promotions: [{
                        icon: 'fa-tags',
                        label: 'Promotion Name'
                    },
                    {
                        icon: 'fa-percentage',
                        label: 'Type'
                    },
                    {
                        icon: 'fa-calendar-alt',
                        label: 'Date Range'
                    },
                    {
                        icon: 'fa-circle',
                        label: 'Status'
                    }
                ]
            };

            const currentFilters = filters[tabName] || filters.customers;
            filtersContent.innerHTML = currentFilters.map(filter => `
      <div class="filter-row">
        <i class="fas ${filter.icon}"></i>
        <span class="filter-label">${filter.label}</span>
        <i class="fas fa-chevron-down" style="font-size: 12px; opacity: 0.6;"></i>
      </div>
    `).join('');
        }

        // Action functions
        function addNewRecord() {
            const activeTab = document.querySelector('.tab-btn.active');
            const tabName = activeTab.textContent.trim();
            if (tabName=="Customers") {
             const tabName='user';
             const nextPage = "add"+tabName.charAt(0).toUpperCase()+tabName.slice(1);
             window.location.href("{{route("addUser")}}");
            }else if (tabName=='Hotels') {
            const  tabName='hotel';
            const nextPage = "add"+tabName.charAt(0).toUpperCase()+tabName.slice(1);
              window.location.href("{{route("addHotel")}}");
            }
            const nextPage = "add"+tabName.charAt(0).toUpperCase()+tabName.slice(1);
            
            //window.location.replace("}");
            //alert('Add new ' + nextPage + ' functionality would open a modal or form here.');
        }

        function exportData() {
            alert('Export data functionality would trigger file download here.');
        }

        function refreshData() {
            alert('Data refreshed!');
            location.reload();
        }

        function viewDetails(type, id) {
            alert('Viewing details for ' + type + ' #' + id);
        }

        function editRecord(type, id) {
            alert('Editing ' + type + ' #' + id);
        }

        // Initialize filters for the first tab
        document.addEventListener('DOMContentLoaded', function() {
            updateFilters('customers');
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            if (!query) return;

            // Simple search implementation - in a real app, this would filter the current tab's data
            console.log('Searching for:', query);
        });
    </script>
</body>

</html>
