@extends('layouts.web')
@section('isi')

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						
						<h1>{{$baca->judul_berita}}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->
	
	<!-- single article section -->
	<div class="mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="single-article-section">
						<div class="single-article-text">
							<img src="{{asset ('file/berita/'.$baca->gambar_berita)}}" style="width: 100%; max-height: 500px; object-fit: contain; background-color: #f8f9fa; border-radius: 8px; margin-bottom: 20px;" alt="">
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> Admin</span>
								<span class="date"><i class="fas fa-calendar"></i> {{ Carbon\Carbon::parse($baca->tanggal_berita)->isoFormat('dddd, D MMMM Y')  }}</span>
							</p>
							<h2>{{$baca->judul_berita}}</h2>
							<p>{!!$baca->isi_berita!!}</p>
							
						</div>

						

						
					</div>
				</div>
				<div class="col-lg-4">
					<div class="sidebar-section">
						<div class="recent-posts">
							<h4>Recent Posts</h4>
							<ul>
                                @foreach ($berita as $row)
                                <li><a href="{{ url('read', $row->slug_berita) }}">{{$row->judul_berita}}</a></li>
                                @endforeach
								
								
							</ul>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single article section -->

    @endsection