<?php
use App\Library\AdminFunction\FunctionLib;
use App\Library\AdminFunction\Define;
?>
<div class="main-content-inner">
    <div class="page-content">
        <div class="line">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="col-md-12">
                        <form id="adminForm" name="adminForm adminFormDevidetAdd" method="post" enctype="multipart/form-data" action="{{URL::route('hr.HrDocumentEdit')}}/{{FunctionLib::inputId($data['hr_document_id'])}}" novalidate="novalidate">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Người nhận</label>
                                        <div class="multipleSelectRecive" multiple style="display: none">
                                            <?php
                                            $hr_document_department_recive_list = isset($data['hr_document_department_recive_list']) ? explode(',', $data['hr_document_department_recive_list']) : array();
                                            ?>
                                            @foreach($arrDepartment as $k=>$val)
                                                <option value="{{$k}}" @if(in_array($k, $hr_document_department_recive_list)) selected="selected" @endif>{{$val}}</option>
                                            @endforeach
                                        </div>
                                        <script>
                                            $('.multipleSelectRecive').fastselect({
                                                placeholder: 'Chọn người nhận',
                                                searchPlaceholder: 'Tìm kiếm',
                                                noResultsText: 'Không có kết quả',
                                                userOptionPrefix: 'Thêm ',
                                                nameElement:'hr_document_department_recive_list'
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>CC</label>
                                        <div class="multipleSelectCC" multiple style="display: none">
                                            <?php
                                            $hr_document_department_cc_list = isset($data['hr_document_department_cc_list']) ? explode(',', $data['hr_document_department_cc_list']) : array();
                                            ?>
                                            @foreach($arrDepartment as $k=>$val)
                                                <option value="{{$k}}" @if(in_array($k, $hr_document_department_cc_list)) selected="selected" @endif>{{$val}}</option>
                                            @endforeach
                                        </div>
                                        <script>
                                            $('.multipleSelectCC').fastselect({
                                                placeholder: 'Chọn người nhận',
                                                searchPlaceholder: 'Tìm kiếm',
                                                noResultsText: 'Không có kết quả',
                                                userOptionPrefix: 'Thêm ',
                                                nameElement:'hr_document_department_cc_list'
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tên văn bản</label>
                                        <input class="form-control input-sm input-required" title="Tên văn bản" id="hr_document_name" name="hr_document_name" @isset($data['hr_document_name'])value="{{$data['hr_document_name']}}"@endif type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <textarea class="form-control input-sm input-required" name="hr_document_content" id="hr_document_content" cols="30" rows="5">@isset($data['hr_document_content']){{$data['hr_document_content']}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">&nbsp;</label>
                                        <div class="controls">
                                            <a href="javascript:;"class="btn btn-primary link-button" onclick="baseUpload.uploadDocumentAdvanced(9);">Tải tệp đính kèm</a>
                                            <div id="sys_show_file">
                                                @if(isset($data['hr_document_files']) && $data['hr_document_files'] !='')
                                                    <?php $arrfiles = ($data['hr_document_files'] != '') ? unserialize($data['hr_document_files']) : array(); ?>
                                                    @foreach($arrfiles as $_key=>$file)
                                                        <div class="item-file item_{{$_key}}"><a target="_blank" href="{{Config::get('config.WEB_ROOT').'uploads/'.Define::FOLDER_DOCUMENT.'/'.$id.'/'.$file}}">{{$file}}</a><span data="{{$file}}" class="remove_file" onclick="baseUpload.deleteDocumentUpload('{{FunctionLib::inputId($id)}}', {{$_key}}, '{{$file}}',9)">X</span></div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {!! csrf_field() !!}
                                    <button type="submit" class="btn btn-success btn-sm submitDocumentSend"><i class="fa fa-save"></i>&nbsp;Lưu hoàn thành</button>
                                    <button type="submit" class="btn btn-success btn-sm submitDocumentDraft"><i class="fa fa-save"></i>&nbsp;Lưu nháp</button>
                                    <input id="id_hiden" name="id_hiden" @isset($data['hr_document_id'])rel="{{$data['hr_document_id']}}" value="{{FunctionLib::inputId($data['hr_document_id'])}}" @else rel="0" value="{{FunctionLib::inputId(0)}}" @endif type="hidden">
                                    <input id="id_hiden_person" name="id_hiden_person" value="{{FunctionLib::inputId(0)}}"type="hidden">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Popup Upload File-->
<div class="modal fade" id="sys_PopupUploadDocumentOtherPro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Tải tệp đính kèm</h4>
            </div>
            <div class="modal-body">
                <form name="uploadImage" method="post" action="#" enctype="multipart/form-data">
                    <div class="form_group">
                        <div id="sys_show_button_upload_file">
                            <div id="sys_mulitplefileuploaderFile" class="btn btn-primary">Tải tệp đính kèm</div>
                        </div>
                        <div id="status_file"></div>

                        <div class="clearfix"></div>
                        <div class="clearfix" style='margin: 5px 10px; width:100%;'>
                            <div id="div_image_file"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Popup Upload File-->