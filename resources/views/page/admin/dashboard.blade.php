<x-app-layout>
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid pt-2">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    @if(Auth::user()->role == 'admin')
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-inverse card-primary">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="mdi mdi-human-greeting"></i></h1>
                                    </div>
                                    <div>
                                        <h3 class="card-title">Users</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <h2 class="font-light text-white">{{ $users }}</h2>
                                    </div>
                                    <div class="col-8 p-t-10 p-b-20 align-self-center">
                                        <div class="usage chartist-chart" style="height:65px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-inverse card-success">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="mdi mdi-burst-mode"></i></h1>
                                    </div>
                                    <div>
                                        <h3 class="card-title">Images</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <h2 class="font-light text-white">{{ $svg }}</h2>
                                    </div>
                                    <div class="col-8 p-t-10 p-b-20 align-self-center">
                                        <div class="usage chartist-chart" style="height:65px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-inverse card-primary">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="mdi mdi-human-greeting"></i></h1>
                                    </div>
                                    <div>
                                        <h3 class="card-title">Posts</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        @php $post = \App\Models\Blog::where('user_id', Auth::user()->id)->get(); $tot_post = $post->count(); @endphp
                                        <h2 class="font-light text-white">{{ $tot_post }}</h2>
                                        <a href="{{ url('create-post') }}" class="btn btn-primary">Add Posts</a>
                                    </div>
                                    <div class="col-8 p-t-10 p-b-20 align-self-center">
                                        
                                        <div class="usage chartist-chart" style="height:65px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
		@push('js')
			<!-- This page plugins -->
			<!-- ============================================================== -->
			<!--c3 JavaScript -->
			<script src="{{ URL::to('assets/plugins/d3/d3.min.js') }}"></script>
			<script src="{{ URL::to('assets/plugins/c3-master/c3.min.js') }}"></script>
			<!-- ============================================================== -->
			<!-- Style switcher -->
			<!-- ============================================================== -->
			<script src="{{ URL::to('assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
		@endpush
</x-app-layout>
