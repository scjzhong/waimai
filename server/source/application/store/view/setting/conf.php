  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" enctype="multipart/form-data" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">商家设置</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require">商家名称</label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="name" value="{{$conf->name}}" required>
                                </div>
                            </div>
                            
                            
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品图片 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <div class="am-form-file">
                                        <button type="button"
                                                class="upload-file am-btn am-btn-secondary am-radius">
                                            <i class="am-icon-cloud-upload"></i> 选择图片
                                        </button>
                                        <div class="uploader-list am-cf">
                                                <div class="file-item">
                                                    <img src="<?php echo $img->file_path?>">
                                                    <input type="hidden" name="img_id"
                                                           value="<?= $conf->img_id; ?>">
                                                    <i class="iconfont icon-shanchu file-item-delete"></i>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="help-block am-margin-top-sm">
                                        <small>尺寸750x750像素以上，大小2M以下 (可拖拽图片调整显示顺序 )</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label  form-require">是否营业</label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="is_open" <?php if($conf->is_open == 1) echo "checked"; ?> value="1"> 营业
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="is_open" value="0" <?php if($conf->is_open == 0) echo "checked"; ?>> 不营业
                                    </label>
                                </div>
                            </div>

                			<div class="layui-form-item" style="margin-left: 17%;">
                		        <div class="layui-inline">
                		            <label class="layui-form-label  form-require">纬度</label>
                		            <div class="layui-input-inline">
                		                <input type="text" name="lat" id="bdlat" class="layui-input" value="{{$conf->longitude}}">
                		            </div>
                		        </div>
                		        <div class="layui-inline">
                		            <label class="layui-form-label  form-require">经度</label>
                		            <div class="layui-input-inline">
                		                <input type="text" name="lng" id="bdlng" class="layui-input" value="{{$conf->latitude}}">
                		            </div>
                		        </div>
                		    </div>
                	        <div class="layui-form-item layui-form-text" style="margin-left: 17%;">
                		        <label class="layui-form-label">地图</label>
                		        <div class="layui-input-block">
                		            <input id="where" type="text" style="width: 50%;" ><input type="button" value="地图上找" class="layui-btn" id="searchbd" /> <br /> 
                		            <div style="width:80%;height:340px;border:1px solid #ccc" id="container"></div>
                		        </div>
                		    </div>

                        	<div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label  form-require">起送价格（单位元）</label>
                                <div class="am-u-sm-9">
                                        <input type="number" min="0" class="tpl-form-input" name="min_price"  value="{{$conf->min_price}}">
                                    </div>
							</div>
							
							<div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label  form-require">配送时间（单位分钟）</label>
                                <div class="am-u-sm-9">
                                        <input type="number" min="0" class="tpl-form-input" name="delivery_time" placeholder="请输入配送时间"  value="{{$conf->delivery_time}}">
                                    </div>
							</div>
							
							<div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label  form-require">配送距离（单位米）</label>
                                <div class="am-u-sm-9">
                                        <input type="number" min="0" class="tpl-form-input" name="delivery_distance"  placeholder="请输入配送距离" value="{{$conf->delivery_distance}}">
                                    </div>
							</div>
							
							<div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label  form-require">配送费（单位元）</label>
                                <div class="am-u-sm-9">
                                        <input type="number" min="0" class="tpl-form-input" name="delivery_price"  placeholder="请输入配送费" value="{{$conf->delivery_price}}">
                                    </div>
							</div>
							
							<div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label  form-require">打包费（单位元）</label>
                                <div class="am-u-sm-9">
                                        <input type="number" min="0" class="tpl-form-input" name="pack_price"  placeholder="请输入打包费" value="{{$conf->pack_price}}">
                                    </div>
							</div>
							
							
          
          

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">
                                    首页公告内容
                                </label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="store[notice]" disabled
                                           value="">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                    <button type="submit" class="j-submit am-btn am-btn-secondary">提交
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 图片文件列表模板 -->
{{include file="layouts/_template/tpl_file_item" /}}
<!-- 文件库弹窗 -->
{{include file="layouts/_template/file_library" /}}

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=GV3YqEkDwpOZroIrcS7zog7cqrPtxjh4"></script>
<script>
    $(function () {
    	//地图搜索
	    $("#searchbd").on("click", function(){
	    	var result = $('#where').val();
	        var local = new BMap.LocalSearch(map, {
	            renderOptions: {map: map}
	        });
	        local.search(result);
	    })
	    
	    //清除地图所有点
	    function deletePoint() {
	        var allOverlay = map.getOverlays();
	        for (var i = 0; i < allOverlay.length - 1; i++) {
	            map.removeOverlay(allOverlay[i]);
	        }
	    }
	  
		var lat = $('#bdlat').val();
	    var lng = $('#bdlng').val();

	    var map = new BMap.Map("container");//在指定的容器内创建地图实例 
	    map.setDefaultCursor("crosshair");//设置地图默认的鼠标指针样式 
	    map.enableScrollWheelZoom();//启用滚轮放大缩小，默认禁用。 
	    var point = new BMap.Point(lng, lat);
	    map.centerAndZoom(point, 13);

	    map.addEventListener("click", function (e) {
	        $('#bdlat').val(e.point.lat);
	        $('#bdlng').val(e.point.lng);
	        map.addOverlay(new BMap.Marker(new BMap.Point(e.point.lng, e.point.lat)));
	        deletePoint();
	    });

	    if (lat < 10 && lng < 100) {
	        toLocation();
	    } else {
	        map.addOverlay(new BMap.Marker(point));
	    }

	    // 定位
	    function toLocation() {
	        var geolocation = new BMap.Geolocation();
	        geolocation.getCurrentPosition(function (r) {
	            if (this.getStatus() == BMAP_STATUS_SUCCESS) {
	                var myIcon = new BMap.Icon("/style/mobile/images/location/dd_01.png", new BMap.Size(30, 30));
	                var marker = new BMap.Marker(r.point, {icon: myIcon});
	                map.addOverlay(marker);
	                map.panTo(r.point);
	            }
	        }, {enableHighAccuracy: true})
	    }


        
    	// 选择图片
        $('.upload-file').selectImages({
            name: 'img_id'
            , multiple: false
        });
        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm();

    });
</script>
