@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-12"><h1>Mappings</h1></div>
  </div>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
    <div class="col mb-4">
      <div class="card">
        <div class="card-header">
          <h2 class="mb-0 font-weight-bold font-16">Course Module Mapping</h2>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item"><a class="stretched-link" href="/cms/course-module-mapping">View</a></li>
            <li class="list-group-item"><a class="stretched-link" href="/cms/course-module-mapping/add">Add</a></li>
            <li class="list-group-item"><a class="stretched-link" href="/cms/course-module-mapping/edit">Edit</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col mb-4">
      <div class="card">
        <div class="card-header">
          <h2 class="mb-0 font-weight-bold font-16">Course Faq Mapping</h2>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item"><a class="stretched-link" href="/cms/course-faq-mapping">View</a></li>
            <li class="list-group-item"><a class="stretched-link" href="/cms/course-faq-mapping/add">Add</a></li>
            <li class="list-group-item"><a class="stretched-link" href="/cms/course-faq-mapping/edit">Edit</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col mb-4">
      <div class="card">
        <div class="card-header">
          <h2 class="mb-0 font-weight-bold font-16">Course Testimonial Mapping</h2>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item"><a class="stretched-link" href="/cms/course-testimonial-mapping">View</a></li>
            <li class="list-group-item"><a class="stretched-link" href="/cms/course-testimonial-mapping/add">Add</a></li>
            <li class="list-group-item"><a class="stretched-link" href="/cms/course-testimonial-mapping/edit">Edit</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col mb-4">
      <div class="card">
        <div class="card-header">
          <h2 class="mb-0 font-weight-bold font-16">Course Faculty Mapping</h2>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item"><a class="stretched-link" href="/cms/course-faculty-mapping">View</a></li>
            <li class="list-group-item"><a class="stretched-link" href="/cms/course-faculty-mapping/add">Add</a></li>
            <li class="list-group-item"><a class="stretched-link" href="/cms/course-faculty-mapping/edit">Edit</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col mb-4">
      <div class="card">
        <div class="card-header">
          <h2 class="mb-0 font-weight-bold font-16">Blog Faq Mapping</h2>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item"><a class="stretched-link" href="/cms/blog-faq-mapping">View</a></li>
            <li class="list-group-item"><a class="stretched-link" href="/cms/blog-faq-mapping/add">Add</a></li>
            <li class="list-group-item"><a class="stretched-link" href="/cms/blog-faq-mapping/edit">Edit</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
@stop