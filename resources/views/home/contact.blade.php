@extends('home.layouts.public')
<title>@yield('title','联系我们')</title>

@section('main')
	<div class="content inner">
		<section class="panel__div clearfix">
			<div class="filter-value">
				<div class="filter-title">用户反馈调查</div>
			</div>
			<form action="contact" method="post" class="issues-box form-horizontal">
			{{csrf_field()}}
				<p>尊敬的用户：</p>
				<p>您好！为了给您提供更好的服务，我们希望收集您使用U袋网的看法或建议，对您的配合和支持表示衷心感谢！</p>
				<div class="form-group">
					<div class="col-xs-6">
						<input type="text" name="name" class="form-control" id="inputPassword" placeholder="姓名" required>
						<p style="color:red;display:none;">姓名是必填的!</p>
					</div>
					<div class="col-xs-6">
						<input type="text" name="phone" class="form-control" id="inputPassword" placeholder="电话号码" required>
						<p style="color:red;display:none;">电话号码是必填的!</p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<textarea class="form-control" rows="5" name="comments" placeholder="请输入您的看法或建议" required></textarea>
						<p style="color:red;display:none;">反馈意见是必填的!</p>
					</div>
				</div>
					<input type="hidden" name="data" value="{{time()}}">
				<div class="form-group">
					<div class="col-xs-5">
						<button type="submit" class="btn btn-block btn-primary">提交</button>
					</div>
				</div>
			</form>
		</section>
	</div>
	<script>
		//名称不能为空
		$("input[name='name']").blur(function(){
			if($(this).val() == ''){
				$(this).next('p').css('display','block');
			}else{
				$(this).next('p').css('display','none');
			}
		});

		//名称不能为空
		$("input[name='phone']").blur(function(){
			if($(this).val() == ''){
				$(this).next('p').css('display','block');
			}else{
				$(this).next('p').css('display','none');
			}
		});

		//意见信息不能为空
		$("textarea").blur(function(){
			if($(this).val() == ''){
				$(this).next('p').css('display','block');
			}else{
				$(this).next('p').css('display','none');
			}
		});
	</script>
@endsection
	