@extends('web.layouts.mainlayout')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Key Officials & Administrative Councils</h1>
        <p class="lead">Central Philippines State University</p>
    </div>

    <style>
        :root { --card-img-h: 200px; }

        /* Common Card Styling */
        .official-card {
            text-align: center;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 16px;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            height: 100%;
            box-shadow: 0 6px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .official-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.1);
        }

        .official-card img {
            width: 100%;
            height: var(--card-img-h);
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 12px;
        }

        .official-card h5 {
            font-weight: 700;
            margin: 8px 0 4px;
            color: #1f5036;
        }

        .official-card p {
            color: #666;
            margin-bottom: 12px;
            font-size: 0.95rem;
        }

        .official-card a {
            margin-top: auto;
            display: inline-block;
            padding: 6px 12px;
            font-size: 0.9rem;
            color: #fff;
            background-color: #1f5036;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .official-card a:hover {
            background-color: #166036;
        }

        /* Responsive Grid for Directors */
        .grid-uniform {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        /* Equal height for Bootstrap row-cols */
        .row-cols-1.row-cols-sm-2.row-cols-md-3.row-cols-lg-4 .col {
            display: flex;
        }

        .row-cols-1.row-cols-sm-2.row-cols-md-3.row-cols-lg-4 .col .official-card {
            flex: 1;
        }

    </style>

    @php
        $officials = [
            [
                'title' => 'University President',
                'name' => 'DR. ALADINO C. MORACA',
                'position' => 'University President',
                'image' => 'https://via.placeholder.com/600x400?text=President',
                'email' => 'president@cpsu.edu.ph',
            ],
        ];
    @endphp

    @foreach($officials as $official)
        <section class="mb-5">
            <h2 class="mb-4 text-center">{{ $official['title'] }}</h2>
            <div class="d-flex justify-content-center">
                <div class="official-card" style="width: 320px;">
                    <img src="{{ $official['image'] }}" alt="{{ $official['title'] }}">
                    <h5>{{ $official['name'] }}</h5>
                    <p>{{ $official['position'] }}</p>
                    <a href="mailto:{{ $official['email'] }}">Contact</a>
                </div>
            </div>
        </section>
    @endforeach


  @php
    $vicePresidents = [
        [
            'name' => 'DR. MARC ALEXIS CAESAR R. BADIAS',
            'position' => 'VP for Research & Extension',
            'image' => 'https://via.placeholder.com/600x400?text=Vice+President',
            'email' => 'vpre@cpsu.edu.ph',
            'alt' => 'VP Research & Extension',
        ],
        [
            'name' => 'DR. GRENLY J. LINGCO',
            'position' => 'VP for Academic Affairs',
            'image' => 'https://via.placeholder.com/600x400?text=Vice+President',
            'email' => 'vpaa@cpsu.edu.ph',
            'alt' => 'VP Academic Affairs',
        ],
    ];
@endphp

<section class="mb-5">
    <h2 class="mb-4 text-center">Vice Presidents</h2>
    <div class="row justify-content-center g-4">
        @foreach($vicePresidents as $vp)
            <div class="col-auto">
                <div class="official-card h-100 text-center" style="width: 320px;">
                    <img src="{{ $vp['image'] }}" alt="{{ $vp['alt'] }}" class="img-fluid mb-3">
                    <h5>{{ $vp['name'] }}</h5>
                    <p>{{ $vp['position'] }}</p>
                    <a href="mailto:{{ $vp['email'] }}">Contact</a>
                </div>
            </div>
        @endforeach
    </div>
</section>


    @php
    $boardAndLegal = [
        [
            'name' => 'NELLY N. CARUAL',
            'position' => 'Board Secretary V',
            'image' => 'https://via.placeholder.com/600x400?text=Board+Secretary',
            'email' => 'boardsecretary@cpsu.edu.ph',
            'alt' => 'Board Secretary',
        ],
        [
            'name' => 'ATTY. RACEL D. MALALU-AN',
            'position' => 'Legal Officer',
            'image' => 'https://via.placeholder.com/600x400?text=Legal+Officer',
            'email' => 'legal@cpsu.edu.ph',
            'alt' => 'Legal Officer',
        ],
    ];
@endphp

<section class="mb-5">
    <h2 class="mb-4 text-center">Board Secretary & Legal Officer</h2>
    <div class="row justify-content-center g-4">
        @foreach($boardAndLegal as $official)
            <div class="col-auto">
                <div class="official-card h-100 text-center" style="width: 320px;">
                    <img src="{{ $official['image'] }}" alt="{{ $official['alt'] }}" class="img-fluid mb-3">
                    <h5>{{ $official['name'] }}</h5>
                    <p>{{ $official['position'] }}</p>
                    <a href="mailto:{{ $official['email'] }}">Contact</a>
                </div>
            </div>
        @endforeach
    </div>
</section>


    @php
        $directors = [
            [
                'name' => 'Director 1',
                'position' => 'Office of Student Affairs',
                'image' => 'https://via.placeholder.com/600x400?text=Director+1',
                'email' => 'director1@cpsu.edu.ph',
            ],
            [
                'name' => 'Director 2',
                'position' => 'Office of Research',
                'image' => 'https://via.placeholder.com/600x400?text=Director+2',
                'email' => 'director2@cpsu.edu.ph',
            ],
            [
                'name' => 'Director 3',
                'position' => 'Office of Extension Services',
                'image' => 'https://via.placeholder.com/600x400?text=Director+3',
                'email' => 'director3@cpsu.edu.ph',
            ],
            [
                'name' => 'Director 4',
                'position' => 'Office of Planning & Development',
                'image' => 'https://via.placeholder.com/600x400?text=Director+4',
                'email' => 'director4@cpsu.edu.ph',
            ],
            [
                'name' => 'Director 5',
                'position' => 'Office of Information Technology',
                'image' => 'https://via.placeholder.com/600x400?text=Director+5',
                'email' => 'director5@cpsu.edu.ph',
            ],
            [
                'name' => 'Director 6',
                'position' => 'Office of Quality Assurance',
                'image' => 'https://via.placeholder.com/600x400?text=Director+6',
                'email' => 'director6@cpsu.edu.ph',
            ],
            [
                'name' => 'Director 7',
                'position' => 'Office of Finance',
                'image' => 'https://via.placeholder.com/600x400?text=Director+7',
                'email' => 'director7@cpsu.edu.ph',
            ],
            [
                'name' => 'Director 8',
                'position' => 'Office of Human Resources',
                'image' => 'https://via.placeholder.com/600x400?text=Director+8',
                'email' => 'director8@cpsu.edu.ph',
            ],
            [
                'name' => 'Director 9',
                'position' => 'Office of Agricultural Programs',
                'image' => 'https://via.placeholder.com/600x400?text=Director+9',
                'email' => 'director9@cpsu.edu.ph',
            ],
            [
                'name' => 'Director 10',
                'position' => 'Office of Graduate Studies',
                'image' => 'https://via.placeholder.com/600x400?text=Director+10',
                'email' => 'director10@cpsu.edu.ph',
            ],
            [
                'name' => 'Director 11',
                    'position' => 'Office of Sports & Cultural Affairs',
                    'image' => 'https://via.placeholder.com/600x400?text=Director+11',
                    'email' => 'director11@cpsu.edu.ph',
                ],
                [
                    'name' => 'Director 12',
                    'position' => 'Office of International Relations',
                    'image' => 'https://via.placeholder.com/600x400?text=Director+12',
                    'email' => 'director12@cpsu.edu.ph',
                ],
            ];
        @endphp

    <section class="mb-5">
        <h2 class="mb-4 text-center">Directors</h2>
        
        @foreach(array_chunk($directors, 4) as $row)
            <div class="row g-4 mb-3 justify-content-center">
                @foreach($row as $director)
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="official-card h-100 text-center">
                            <img src="{{ $director['image'] }}" alt="{{ $director['name'] }}" class="img-fluid mb-3">
                            <h5>{{ $director['name'] }}</h5>
                            <p>{{ $director['position'] }}</p>
                            <a href="mailto:{{ $director['email'] }}">Contact</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </section>



  @php
    $vpAdminFinance = [
        [
            'name' => 'Chief Administrative Officer - Finance',
            'position' => 'VP for Administration & Finance',
            'image' => 'https://via.placeholder.com/600x400?text=CAO+Finance',
            'email' => 'cao.finance@cpsu.edu.ph',
        ],
        [
            'name' => 'Chief Administrative Officer - Admin',
            'position' => 'VP for Administration & Finance',
            'image' => 'https://via.placeholder.com/600x400?text=CAO+Admin',
            'email' => 'cao.admin@cpsu.edu.ph',
        ],
        [
            'name' => 'Supervising Administrative Officer 1',
            'position' => 'VP for Administration & Finance',
            'image' => 'https://via.placeholder.com/600x400?text=SAO+1',
            'email' => 'sao1@cpsu.edu.ph',
        ],
        [
            'name' => 'Supervising Administrative Officer 2',
            'position' => 'VP for Administration & Finance',
            'image' => 'https://via.placeholder.com/600x400?text=SAO+2',
            'email' => 'sao2@cpsu.edu.ph',
        ],
        [
            'name' => 'Supervising Administrative Officer - MIS',
            'position' => 'VP for Administration & Finance',
            'image' => 'https://via.placeholder.com/600x400?text=MIS+1',
            'email' => 'mis@cpsu.edu.ph',
        ],
        [
            'name' => 'Supervising Administrative Officer - PEDO',
            'position' => 'VP for Administration & Finance',
            'image' => 'https://via.placeholder.com/600x400?text=PEDO+2',
            'email' => 'pedo@cpsu.edu.ph',
        ],
    ];
@endphp

<section class="mb-5">
    <h2 class="mb-4 text-center">Vice President for Administration and Finance</h2>
    <div class="container">

        <!-- Row 1: CAO Finance -->
        <div class="row justify-content-center mb-4">
            <div class="col-auto">
                <div class="official-card h-100 text-center" style="width: 320px;">
                    <img src="{{ $vpAdminFinance[0]['image'] }}" alt="{{ $vpAdminFinance[0]['name'] }}" class="img-fluid mb-3">
                    <h5>{{ $vpAdminFinance[0]['name'] }}</h5>
                    <p>{{ $vpAdminFinance[0]['position'] }}</p>
                    <a href="mailto:{{ $vpAdminFinance[0]['email'] }}">Contact</a>
                </div>
            </div>
        </div>

        <!-- Row 2: CAO Admin -->
        <div class="row justify-content-center mb-4">
            <div class="col-auto">
                <div class="official-card h-100 text-center" style="width: 320px;">
                    <img src="{{ $vpAdminFinance[1]['image'] }}" alt="{{ $vpAdminFinance[1]['name'] }}" class="img-fluid mb-3">
                    <h5>{{ $vpAdminFinance[1]['name'] }}</h5>
                    <p>{{ $vpAdminFinance[1]['position'] }}</p>
                    <a href="mailto:{{ $vpAdminFinance[1]['email'] }}">Contact</a>
                </div>
            </div>
        </div>

        <!-- Row 3: SAO 1 & SAO 2 -->
        <div class="row justify-content-center g-4 mb-4">
            @foreach([$vpAdminFinance[2], $vpAdminFinance[3]] as $official)
                <div class="col-auto">
                    <div class="official-card h-100 text-center" style="width: 320px;">
                        <img src="{{ $official['image'] }}" alt="{{ $official['name'] }}" class="img-fluid mb-3">
                        <h5>{{ $official['name'] }}</h5>
                        <p>{{ $official['position'] }}</p>
                        <a href="mailto:{{ $official['email'] }}">Contact</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Row 4: MIS & PEDO -->
        <div class="row justify-content-center g-4">
            @foreach([$vpAdminFinance[4], $vpAdminFinance[5]] as $official)
                <div class="col-auto">
                    <div class="official-card h-100 text-center" style="width: 320px;">
                        <img src="{{ $official['image'] }}" alt="{{ $official['name'] }}" class="img-fluid mb-3">
                        <h5>{{ $official['name'] }}</h5>
                        <p>{{ $official['position'] }}</p>
                        <a href="mailto:{{ $official['email'] }}">Contact</a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>



@php
    $directors = [
        [
            'name' => 'Director 1',
            'position' => 'Office Name',
            'image' => 'https://via.placeholder.com/600x400?text=Director+1',
            'email' => 'director1@cpsu.edu.ph',
        ],
        [
            'name' => 'Director 2',
            'position' => 'Office Name',
            'image' => 'https://via.placeholder.com/600x400?text=Director+2',
            'email' => 'director2@cpsu.edu.ph',
        ],
        [
            'name' => 'Director 3',
            'position' => 'Office Name',
            'image' => 'https://via.placeholder.com/600x400?text=Director+3',
            'email' => 'director3@cpsu.edu.ph',
        ],
        [
            'name' => 'Director 4',
            'position' => 'Office Name',
            'image' => 'https://via.placeholder.com/600x400?text=Director+4',
            'email' => 'director4@cpsu.edu.ph',
        ],
        [
            'name' => 'Director 5',
            'position' => 'Office Name',
            'image' => 'https://via.placeholder.com/600x400?text=Director+5',
            'email' => 'director5@cpsu.edu.ph',
        ],
        [
            'name' => 'Director 6',
            'position' => 'Office Name',
            'image' => 'https://via.placeholder.com/600x400?text=Director+6',
            'email' => 'director6@cpsu.edu.ph',
        ],
        [
            'name' => 'Director 7',
            'position' => 'Office Name',
            'image' => 'https://via.placeholder.com/600x400?text=Director+7',
            'email' => 'director7@cpsu.edu.ph',
        ],
        [
            'name' => 'Director 8',
            'position' => 'Office Name',
            'image' => 'https://via.placeholder.com/600x400?text=Director+8',
            'email' => 'director8@cpsu.edu.ph',
        ],
    ];
@endphp

<section class="mb-5">
    <h2 class="mb-4 text-center">Supervising Administrative Officer for Administration</h2>

    <!-- President -->
    <div class="d-flex justify-content-center mb-5">
        <div class="official-card text-center" style="width: 320px;">
            <img src="https://via.placeholder.com/600x400?text=President" alt="President" class="img-fluid mb-3">
            <h5>DR. ALADINO C. MORACA</h5>
            <p>University President</p>
            <a href="mailto:president@cpsu.edu.ph">Contact</a>
        </div>
    </div>

    <!-- Directors (strictly 4 per row) -->
    <div class="row g-4">
        @foreach($directors as $director)
            <div class="col-3">
                <div class="official-card h-100 text-center">
                    <img src="{{ $director['image'] }}" alt="{{ $director['name'] }}" class="img-fluid mb-3">
                    <h5>{{ $director['name'] }}</h5>
                    <p>{{ $director['position'] }}</p>
                    <a href="mailto:{{ $director['email'] }}">Contact</a>
                </div>
            </div>
        @endforeach
    </div>
</section>




@php
$vpaa_officials = [
    [
        'name' => 'Vice President of Academic Affairs',
        'position' => 'Academic Affairs',
        'image' => 'https://via.placeholder.com/600x400?text=VPAA',
        'email' => 'vpaa@cpsu.edu.ph',
    ],
    [
        'name' => 'Supervising Administrative Officer - Library',
        'position' => 'Academic Affairs',
        'image' => 'https://via.placeholder.com/600x400?text=Library',
        'email' => 'library@cpsu.edu.ph',
    ],
    [
        'name' => 'Supervising Administrative Officer - Registrar',
        'position' => 'Academic Affairs',
        'image' => 'https://via.placeholder.com/600x400?text=Registrar',
        'email' => 'registrar@cpsu.edu.ph',
    ],
];
@endphp

<section class="mb-5">
    <h2 class="mb-4 text-center">Vice President of Academic Affairs</h2>
    <div class="container">

        <!-- Row 1: VPAA -->
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-md-4">
                <div class="official-card h-100 text-center">
                    <img src="{{ $vpaa_officials[0]['image'] }}" alt="{{ $vpaa_officials[0]['name'] }}" class="img-fluid mb-3">
                    <h5>{{ $vpaa_officials[0]['name'] }}</h5>
                    <p>{{ $vpaa_officials[0]['position'] }}</p>
                    <a href="mailto:{{ $vpaa_officials[0]['email'] }}">Contact</a>
                </div>
            </div>
        </div>

        <!-- Row 2: Library & Registrar -->
        <div class="row justify-content-center g-4">
            @foreach($vpaa_officials as $index => $official)
                @if($index > 0) {{-- Skip the first one (VPAA already displayed above) --}}
                    <div class="col-12 col-md-4">
                        <div class="official-card h-100 text-center">
                            <img src="{{ $official['image'] }}" alt="{{ $official['name'] }}" class="img-fluid mb-3">
                            <h5>{{ $official['name'] }}</h5>
                            <p>{{ $official['position'] }}</p>
                            <a href="mailto:{{ $official['email'] }}">Contact</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>
</section>


@php
$administrators = [
    [
        'name' => 'Administrator 1',
        'position' => 'Campus Name',
        'image' => 'https://via.placeholder.com/600x400?text=Administrator+1',
        'email' => 'admin1@cpsu.edu.ph',
    ],
    [
        'name' => 'Administrator 2',
        'position' => 'Campus Name',
        'image' => 'https://via.placeholder.com/600x400?text=Administrator+2',
        'email' => 'admin2@cpsu.edu.ph',
    ],
    [
        'name' => 'Administrator 3',
        'position' => 'Campus Name',
        'image' => 'https://via.placeholder.com/600x400?text=Administrator+3',
        'email' => 'admin3@cpsu.edu.ph',
    ],
    [
        'name' => 'Administrator 4',
        'position' => 'Campus Name',
        'image' => 'https://via.placeholder.com/600x400?text=Administrator+4',
        'email' => 'admin4@cpsu.edu.ph',
    ],
    [
        'name' => 'Administrator 5',
        'position' => 'Campus Name',
        'image' => 'https://via.placeholder.com/600x400?text=Administrator+5',
        'email' => 'admin5@cpsu.edu.ph',
    ],
    [
        'name' => 'Administrator 6',
        'position' => 'Campus Name',
        'image' => 'https://via.placeholder.com/600x400?text=Administrator+6',
        'email' => 'admin6@cpsu.edu.ph',
    ],
    [
        'name' => 'Administrator 7',
        'position' => 'Campus Name',
        'image' => 'https://via.placeholder.com/600x400?text=Administrator+7',
        'email' => 'admin7@cpsu.edu.ph',
    ],
    [
        'name' => 'Administrator 8',
        'position' => 'Campus Name',
        'image' => 'https://via.placeholder.com/600x400?text=Administrator+8',
        'email' => 'admin8@cpsu.edu.ph',
    ],
    [
        'name' => 'Administrator 9',
        'position' => 'Campus Name',
        'image' => 'https://via.placeholder.com/600x400?text=Administrator+9',
        'email' => 'admin9@cpsu.edu.ph',
    ],
    [
        'name' => 'Administrator 10',
        'position' => 'Campus Name',
        'image' => 'https://via.placeholder.com/600x400?text=Administrator+10',
        'email' => 'admin10@cpsu.edu.ph',
    ],
];
@endphp

<!-- Campus Administrators -->
<section class="mb-5">
    <h2 class="mb-4 text-center">Campus Administrators</h2>
    <div class="container">
        @foreach(array_chunk($administrators, 4) as $chunk)
            <div class="row g-4 {{ count($chunk) < 4 ? 'justify-content-center' : '' }}">
                @foreach($chunk as $admin)
                    <div class="col-md-3 col-sm-6">
                        <div class="official-card h-100 text-center p-3" style="width: 100%;">
                            <img src="{{ $admin['image'] }}" alt="{{ $admin['name'] }}" class="img-fluid mb-3">
                            <h5>{{ $admin['name'] }}</h5>
                            <p>{{ $admin['position'] }}</p>
                            <a href="mailto:{{ $admin['email'] }}">Contact</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>


@php
$deans = [
    [
        'name' => 'Dean 1',
        'position' => 'College Name',
        'image' => 'https://via.placeholder.com/600x400?text=Dean+1',
        'email' => 'dean1@cpsu.edu.ph',
    ],
    [
        'name' => 'Dean 2',
        'position' => 'College Name',
        'image' => 'https://via.placeholder.com/600x400?text=Dean+2',
        'email' => 'dean2@cpsu.edu.ph',
    ],
    [
        'name' => 'Dean 3',
        'position' => 'College Name',
        'image' => 'https://via.placeholder.com/600x400?text=Dean+3',
        'email' => 'dean3@cpsu.edu.ph',
    ],
    [
        'name' => 'Dean 4',
        'position' => 'College Name',
        'image' => 'https://via.placeholder.com/600x400?text=Dean+4',
        'email' => 'dean4@cpsu.edu.ph',
    ],
    [
        'name' => 'Dean 5',
        'position' => 'College Name',
        'image' => 'https://via.placeholder.com/600x400?text=Dean+5',
        'email' => 'dean5@cpsu.edu.ph',
    ],
    [
        'name' => 'Dean 6',
        'position' => 'College Name',
        'image' => 'https://via.placeholder.com/600x400?text=Dean+6',
        'email' => 'dean6@cpsu.edu.ph',
    ],
    [
        'name' => 'Dean 7',
        'position' => 'College Name',
        'image' => 'https://via.placeholder.com/600x400?text=Dean+7',
        'email' => 'dean7@cpsu.edu.ph',
    ],
    [
        'name' => 'Dean 8',
        'position' => 'College Name',
        'image' => 'https://via.placeholder.com/600x400?text=Dean+8',
        'email' => 'dean8@cpsu.edu.ph',
    ],
    [
        'name' => 'Dean 9',
        'position' => 'College Name',
        'image' => 'https://via.placeholder.com/600x400?text=Dean+9',
        'email' => 'dean9@cpsu.edu.ph',
    ],
];
@endphp

<!-- Deans -->
<section class="mb-5">
    <h2 class="mb-4 text-center">Deans</h2>
    <div class="container">
        @foreach(array_chunk($deans, 3) as $chunk)
            <div class="row g-4 {{ count($chunk) < 3 ? 'justify-content-center' : '' }}">
                @foreach($chunk as $dean)
                    <div class="col-md-4 col-sm-6">
                        <div class="official-card h-100 text-center p-3">
                            <img src="{{ $dean['image'] }}" alt="{{ $dean['name'] }}" class="img-fluid mb-3">
                            <h5>{{ $dean['name'] }}</h5>
                            <p>{{ $dean['position'] }}</p>
                            <a href="mailto:{{ $dean['email'] }}">Contact</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>

@php
$directors = [
    [
        'name' => 'Director 1',
        'position' => 'Office Name',
        'image' => 'https://via.placeholder.com/600x400?text=Director+1',
        'email' => 'director1@cpsu.edu.ph',
    ],
    [
        'name' => 'Director 2',
        'position' => 'Office Name',
        'image' => 'https://via.placeholder.com/600x400?text=Director+2',
        'email' => 'director2@cpsu.edu.ph',
    ],
    [
        'name' => 'Director 3',
        'position' => 'Office Name',
        'image' => 'https://via.placeholder.com/600x400?text=Director+3',
        'email' => 'director3@cpsu.edu.ph',
    ],
    [
        'name' => 'Director 4',
        'position' => 'Office Name',
        'image' => 'https://via.placeholder.com/600x400?text=Director+4',
        'email' => 'director4@cpsu.edu.ph',
    ],
    [
        'name' => 'Director 5',
        'position' => 'Office Name',
        'image' => 'https://via.placeholder.com/600x400?text=Director+5',
        'email' => 'director5@cpsu.edu.ph',
    ],
    [
        'name' => 'Director 6',
        'position' => 'Office Name',
        'image' => 'https://via.placeholder.com/600x400?text=Director+6',
        'email' => 'director6@cpsu.edu.ph',
    ],
    [
        'name' => 'Director 7',
        'position' => 'Office Name',
        'image' => 'https://via.placeholder.com/600x400?text=Director+7',
        'email' => 'director7@cpsu.edu.ph',
    ],
    [
        'name' => 'Director 8',
        'position' => 'Office Name',
        'image' => 'https://via.placeholder.com/600x400?text=Director+8',
        'email' => 'director8@cpsu.edu.ph',
    ],
    [
        'name' => 'Director 9',
        'position' => 'Office Name',
        'image' => 'https://via.placeholder.com/600x400?text=Director+9',
        'email' => 'director9@cpsu.edu.ph',
    ],
    [
        'name' => 'Director 10',
        'position' => 'Office Name',
        'image' => 'https://via.placeholder.com/600x400?text=Director+10',
        'email' => 'director10@cpsu.edu.ph',
    ],
    [
        'name' => 'Director 11',
        'position' => 'Office Name',
        'image' => 'https://via.placeholder.com/600x400?text=Director+11',
        'email' => 'director11@cpsu.edu.ph',
    ],
];
@endphp

<!-- Directors under VPAA -->
<section class="mb-5">
    <h2 class="mb-4 text-center">Directors under the Vice President for Academic Affairs</h2>
    <div class="container">
        @foreach(array_chunk($directors, 3) as $chunk)
            <div class="row g-4 {{ count($chunk) < 3 ? 'justify-content-center' : '' }}">
                @foreach($chunk as $director)
                    <div class="col-md-4 col-sm-6 d-flex justify-content-center">
                        <div class="official-card text-center" style="width: 320px;">
                            <img src="{{ $director['image'] }}" alt="{{ $director['name'] }}" class="img-fluid mb-3">
                            <h5>{{ $director['name'] }}</h5>
                            <p>{{ $director['position'] }}</p>
                            <a href="mailto:{{ $director['email'] }}">Contact</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>


</div>
@endsection
