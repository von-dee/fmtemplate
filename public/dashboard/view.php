<div class="page-dashboard">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">
                Dashboard
            </h1>
        </div>
        <div class="row row-cards">
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right text-green">
                            6%
                            <i class="fe fe-chevron-up"></i>
                        </div>
                        <div class="h1 m-0">43</div>
                        <div class="text-muted mb-4">New Tickets</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right text-red">
                            -3%
                            <i class="fe fe-chevron-down"></i>
                        </div>
                        <div class="h1 m-0">17</div>
                        <div class="text-muted mb-4">Closed Today</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right text-green">
                            9%
                            <i class="fe fe-chevron-up"></i>
                        </div>
                        <div class="h1 m-0">7</div>
                        <div class="text-muted mb-4">New Replies</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right text-green">
                            3%
                            <i class="fe fe-chevron-up"></i>
                        </div>
                        <div class="h1 m-0">27.3K</div>
                        <div class="text-muted mb-4">Followers</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right text-red">
                            -2%
                            <i class="fe fe-chevron-down"></i>
                        </div>
                        <div class="h1 m-0">$95</div>
                        <div class="text-muted mb-4">Daily Earnings</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                    <div class="card-body p-3 text-center">
                        <div class="text-right text-red">
                            -1%
                            <i class="fe fe-chevron-down"></i>
                        </div>
                        <div class="h1 m-0">621</div>
                        <div class="text-muted mb-4">Products</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Development Activity</h3>
                    </div>
                    <div id="chart-development-activity" style="height: 10rem"></div>
                    <div class="table-responsive">
                        <table class="table card-table table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th colspan="2">User</th>
                                    <th>Commit</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="w-1"><span class="avatar"
                                            style="background-image: url(./demo/faces/male/9.jpg)"></span></td>
                                    <td>Ronald Bradley</td>
                                    <td>Initial commit</td>
                                    <td class="text-nowrap">May 6, 2018</td>
                                    <td class="w-1"><a href="#" class="icon"><i class="fe fe-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td><span class="avatar">BM</span></td>
                                    <td>Russell Gibson</td>
                                    <td>Main structure</td>
                                    <td class="text-nowrap">April 22, 2018</td>
                                    <td><a href="#" class="icon"><i class="fe fe-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td><span class="avatar"
                                            style="background-image: url(./demo/faces/female/1.jpg)"></span></td>
                                    <td>Beverly Armstrong</td>
                                    <td>Left sidebar adjustments</td>
                                    <td class="text-nowrap">April 15, 2018</td>
                                    <td><a href="#" class="icon"><i class="fe fe-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td><span class="avatar"
                                            style="background-image: url(./demo/faces/male/4.jpg)"></span></td>
                                    <td>Bobby Knight</td>
                                    <td>Topbar dropdown style</td>
                                    <td class="text-nowrap">April 8, 2018</td>
                                    <td><a href="#" class="icon"><i class="fe fe-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td><span class="avatar"
                                            style="background-image: url(./demo/faces/female/11.jpg)"></span></td>
                                    <td>Sharon Wells</td>
                                    <td>Fixes #625</td>
                                    <td class="text-nowrap">April 9, 2018</td>
                                    <td><a href="#" class="icon"><i class="fe fe-trash"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <script>
                    require(['c3', 'jquery'], function (c3, $) {
                        $(document).ready(function () {
                            var chart = c3.generate({
                                bindto: '#chart-development-activity', // id of chart wrapper
                                data: {
                                    columns: [
                                        // each columns data
                                        ['data1', 0, 5, 1, 2, 7, 5, 6, 8, 24, 7, 12, 5, 6,
                                            3, 2, 2, 6, 30, 10, 10, 15, 14, 47, 65, 55
                                        ]
                                    ],
                                    type: 'area', // default type of chart
                                    groups: [
                                        ['data1', 'data2', 'data3']
                                    ],
                                    colors: {
                                        'data1': tabler.colors["blue"]
                                    },
                                    names: {
                                        // name of each serie
                                        'data1': 'Purchases'
                                    }
                                },
                                axis: {
                                    y: {
                                        padding: {
                                            bottom: 0,
                                        },
                                        show: false,
                                        tick: {
                                            outer: false
                                        }
                                    },
                                    x: {
                                        padding: {
                                            left: 0,
                                            right: 0
                                        },
                                        show: false
                                    }
                                },
                                legend: {
                                    position: 'inset',
                                    padding: 0,
                                    inset: {
                                        anchor: 'top-left',
                                        x: 20,
                                        y: 8,
                                        step: 10
                                    }
                                },
                                tooltip: {
                                    format: {
                                        title: function (x) {
                                            return '';
                                        }
                                    }
                                },
                                padding: {
                                    bottom: 0,
                                    left: -1,
                                    right: -1
                                },
                                point: {
                                    show: false
                                }
                            });
                        });
                    });
                </script>
            </div>
            <div class="col-md-6">
                <div class="alert alert-primary">Are you in trouble? <a href="./docs/index.html" class="alert-link">Read
                        our documentation</a> with code samples.</div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Chart title</h3>
                            </div>
                            <div class="card-body">
                                <div id="chart-donut" style="height: 12rem;"></div>
                            </div>
                        </div>
                        <script>
                            require(['c3', 'jquery'], function (c3, $) {
                                $(document).ready(function () {
                                    var chart = c3.generate({
                                        bindto: '#chart-donut', // id of chart wrapper
                                        data: {
                                            columns: [
                                                // each columns data
                                                ['data1', 63],
                                                ['data2', 37]
                                            ],
                                            type: 'donut', // default type of chart
                                            colors: {
                                                'data1': tabler.colors["green"],
                                                'data2': tabler.colors["green-light"]
                                            },
                                            names: {
                                                // name of each serie
                                                'data1': 'Maximum',
                                                'data2': 'Minimum'
                                            }
                                        },
                                        axis: {},
                                        legend: {
                                            show: false, //hide legend
                                        },
                                        padding: {
                                            bottom: 0,
                                            top: 0
                                        },
                                    });
                                });
                            });
                        </script>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Chart title</h3>
                            </div>
                            <div class="card-body">
                                <div id="chart-pie" style="height: 12rem;"></div>
                            </div>
                        </div>
                        <script>
                            require(['c3', 'jquery'], function (c3, $) {
                                $(document).ready(function () {
                                    var chart = c3.generate({
                                        bindto: '#chart-pie', // id of chart wrapper
                                        data: {
                                            columns: [
                                                // each columns data
                                                ['data1', 63],
                                                ['data2', 44],
                                                ['data3', 12],
                                                ['data4', 14]
                                            ],
                                            type: 'pie', // default type of chart
                                            colors: {
                                                'data1': tabler.colors["blue-darker"],
                                                'data2': tabler.colors["blue"],
                                                'data3': tabler.colors["blue-light"],
                                                'data4': tabler.colors["blue-lighter"]
                                            },
                                            names: {
                                                // name of each serie
                                                'data1': 'A',
                                                'data2': 'B',
                                                'data3': 'C',
                                                'data4': 'D'
                                            }
                                        },
                                        axis: {},
                                        legend: {
                                            show: false, //hide legend
                                        },
                                        padding: {
                                            bottom: 0,
                                            top: 0
                                        },
                                    });
                                });
                            });
                        </script>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="h5">New feedback</div>
                                <div class="display-4 font-weight-bold mb-4">62</div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-red" style="width: 28%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="h5">Today profit</div>
                                <div class="display-4 font-weight-bold mb-4">$652</div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" style="width: 84%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="h5">Users online</div>
                                <div class="display-4 font-weight-bold mb-4">76</div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-yellow" style="width: 34%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cards row-deck">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                            <thead>
                                <tr>
                                    <th class="text-center w-1"><i class="icon-people"></i></th>
                                    <th>User</th>
                                    <th>Usage</th>
                                    <th class="text-center">Payment</th>
                                    <th>Activity</th>
                                    <th class="text-center">Satisfaction</th>
                                    <th class="text-center"><i class="icon-settings"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <div class="avatar d-block"
                                            style="background-image: url(demo/faces/female/26.jpg)">
                                            <span class="avatar-status bg-green"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>Elizabeth Martin</div>
                                        <div class="small text-muted">
                                            Registered: Mar 9, 2018
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <strong>42%</strong>
                                            </div>
                                            <div class="float-right">
                                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-yellow" role="progressbar" style="width: 42%"
                                                aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <i class="payment payment-visa"></i>
                                    </td>
                                    <td>
                                        <div class="small text-muted">Last login</div>
                                        <div>4 minutes ago</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mx-auto chart-circle chart-circle-xs" data-value="0.42"
                                            data-thickness="3" data-color="blue">
                                            <div class="chart-circle-value">42%</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="item-action dropdown">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i
                                                    class="fe fe-more-vertical"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-tag"></i> Action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-message-square"></i> Something else
                                                    here</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-link"></i> Separated link</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="avatar d-block"
                                            style="background-image: url(demo/faces/female/17.jpg)">
                                            <span class="avatar-status bg-green"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>Michelle Schultz</div>
                                        <div class="small text-muted">
                                            Registered: Feb 21, 2018
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <strong>0%</strong>
                                            </div>
                                            <div class="float-right">
                                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-red" role="progressbar" style="width: 0%"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <i class="payment payment-googlewallet"></i>
                                    </td>
                                    <td>
                                        <div class="small text-muted">Last login</div>
                                        <div>5 minutes ago</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mx-auto chart-circle chart-circle-xs" data-value="0.0"
                                            data-thickness="3" data-color="blue">
                                            <div class="chart-circle-value">0%</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="item-action dropdown">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i
                                                    class="fe fe-more-vertical"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-tag"></i> Action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-message-square"></i> Something else
                                                    here</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-link"></i> Separated link</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="avatar d-block"
                                            style="background-image: url(demo/faces/female/21.jpg)">
                                            <span class="avatar-status bg-green"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>Crystal Austin</div>
                                        <div class="small text-muted">
                                            Registered: Mar 28, 2018
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <strong>96%</strong>
                                            </div>
                                            <div class="float-right">
                                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-green" role="progressbar" style="width: 96%"
                                                aria-valuenow="96" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <i class="payment payment-mastercard"></i>
                                    </td>
                                    <td>
                                        <div class="small text-muted">Last login</div>
                                        <div>a minute ago</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mx-auto chart-circle chart-circle-xs" data-value="0.96"
                                            data-thickness="3" data-color="blue">
                                            <div class="chart-circle-value">96%</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="item-action dropdown">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i
                                                    class="fe fe-more-vertical"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-tag"></i> Action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-message-square"></i> Something else
                                                    here</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-link"></i> Separated link</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="avatar d-block"
                                            style="background-image: url(demo/faces/male/32.jpg)">
                                            <span class="avatar-status bg-green"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>Douglas Ray</div>
                                        <div class="small text-muted">
                                            Registered: Jan 6, 2018
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <strong>6%</strong>
                                            </div>
                                            <div class="float-right">
                                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-red" role="progressbar" style="width: 6%"
                                                aria-valuenow="6" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <i class="payment payment-shopify"></i>
                                    </td>
                                    <td>
                                        <div class="small text-muted">Last login</div>
                                        <div>a minute ago</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mx-auto chart-circle chart-circle-xs" data-value="0.06"
                                            data-thickness="3" data-color="blue">
                                            <div class="chart-circle-value">6%</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="item-action dropdown">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i
                                                    class="fe fe-more-vertical"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-tag"></i> Action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-message-square"></i> Something else
                                                    here</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-link"></i> Separated link</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="avatar d-block"
                                            style="background-image: url(demo/faces/female/12.jpg)">
                                            <span class="avatar-status bg-green"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>Teresa Reyes</div>
                                        <div class="small text-muted">
                                            Registered: Feb 23, 2018
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <strong>36%</strong>
                                            </div>
                                            <div class="float-right">
                                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-red" role="progressbar" style="width: 36%"
                                                aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <i class="payment payment-ebay"></i>
                                    </td>
                                    <td>
                                        <div class="small text-muted">Last login</div>
                                        <div>2 minutes ago</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mx-auto chart-circle chart-circle-xs" data-value="0.36"
                                            data-thickness="3" data-color="blue">
                                            <div class="chart-circle-value">36%</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="item-action dropdown">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i
                                                    class="fe fe-more-vertical"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-tag"></i> Action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-message-square"></i> Something else
                                                    here</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-link"></i> Separated link</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="avatar d-block"
                                            style="background-image: url(demo/faces/female/4.jpg)">
                                            <span class="avatar-status bg-green"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>Emma Wade</div>
                                        <div class="small text-muted">
                                            Registered: Mar 10, 2018
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <strong>7%</strong>
                                            </div>
                                            <div class="float-right">
                                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-red" role="progressbar" style="width: 7%"
                                                aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <i class="payment payment-paypal"></i>
                                    </td>
                                    <td>
                                        <div class="small text-muted">Last login</div>
                                        <div>a minute ago</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mx-auto chart-circle chart-circle-xs" data-value="0.07"
                                            data-thickness="3" data-color="blue">
                                            <div class="chart-circle-value">7%</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="item-action dropdown">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i
                                                    class="fe fe-more-vertical"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-tag"></i> Action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-message-square"></i> Something else
                                                    here</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-link"></i> Separated link</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="avatar d-block"
                                            style="background-image: url(demo/faces/female/27.jpg)">
                                            <span class="avatar-status bg-green"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>Carol Henderson</div>
                                        <div class="small text-muted">
                                            Registered: Feb 12, 2018
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <strong>80%</strong>
                                            </div>
                                            <div class="float-right">
                                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-green" role="progressbar" style="width: 80%"
                                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <i class="payment payment-visa"></i>
                                    </td>
                                    <td>
                                        <div class="small text-muted">Last login</div>
                                        <div>9 minutes ago</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mx-auto chart-circle chart-circle-xs" data-value="0.8"
                                            data-thickness="3" data-color="blue">
                                            <div class="chart-circle-value">80%</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="item-action dropdown">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i
                                                    class="fe fe-more-vertical"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-tag"></i> Action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-message-square"></i> Something else
                                                    here</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-link"></i> Separated link</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="avatar d-block"
                                            style="background-image: url(demo/faces/male/20.jpg)">
                                            <span class="avatar-status bg-green"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>Christopher Harvey</div>
                                        <div class="small text-muted">
                                            Registered: Jan 12, 2018
                                        </div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-left">
                                                <strong>83%</strong>
                                            </div>
                                            <div class="float-right">
                                                <small class="text-muted">Jun 11, 2015 - Jul 10, 2015</small>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-green" role="progressbar" style="width: 83%"
                                                aria-valuenow="83" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <i class="payment payment-googlewallet"></i>
                                    </td>
                                    <td>
                                        <div class="small text-muted">Last login</div>
                                        <div>8 minutes ago</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="mx-auto chart-circle chart-circle-xs" data-value="0.83"
                                            data-thickness="3" data-color="blue">
                                            <div class="chart-circle-value">83%</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="item-action dropdown">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i
                                                    class="fe fe-more-vertical"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-tag"></i> Action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-message-square"></i> Something else
                                                    here</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fe fe-link"></i> Separated link</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>