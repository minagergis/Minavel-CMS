@extends('admin::layouts.master')

@section('styles')

@stop

@section('content')

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Add New Contact Form</span>
                        </div> 
                    </div>
                    <!-- BEGIN PAGE BASE CONTENT -->

                    <form  class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ route('admin.permissions.add.post', \Request::get('post_type')) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                      
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="title" value="" size="30" id="title" class="form-control" placeholder="Enter title here" spellcheck="true" autocomplete="off">
                                <hr>
                                 <ul class="nav nav-tabs">
                                    <li class="active">
                                       <a href="#form" data-toggle="tab" aria-expanded="true"> Form </a>
                                    </li>
                                    <li class="">
                                       <a href="#mail" data-toggle="tab" aria-expanded="false"> Mail </a>
                                    </li>
                                    <li class="">
                                       <a href="#messages" data-toggle="tab" aria-expanded="false"> Messages </a>
                                    </li>
                                    <li class="">
                                       <a href="#settings" data-toggle="tab" aria-expanded="false"> Additional Settings </a>
                                    </li>
                                 </ul>
                                 <div class="tab-content">
                                    <div class="tab-pane fade active in" id="form">
                                        <h3>Form</h3>
                                        <div class="form-group {{ $errors->has('contact-form') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <textarea id="contact-form" name="contact-form" rows="24" class="form-control form-control" style="height: 444px;"></textarea>
                                                @if ($errors->has('contact-form'))
                                                    <span class="help-block">{{ $errors->first('contact-form') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade contact-mail-tab" id="mail">
                                       <h3>Mail</h3>
                                          In the following fields, you can use these mail-tags:<br>
                                             <span>[your-name]</span><span>[your-email]</span><span>[your-subject]</span><span>[your-message]</span>

                                          <div class="row">
                                             <div class="col-md-2">
                                                <label for="mail-recipient">To</label>
                                             </div>
                                             <div class="col-md-10">
                                                <input type="text" id="mail-recipient" name="mail-recipient" class="form-control" size="70" value="creatova2015@gmail.com">
                                             </div>
                                          </div>

                                          <div class="row">
                                             <div class="col-md-2">
                                                <label for="mail-sender">From</label>
                                             </div>
                                             <div class="col-md-10">
                                                <input type="text" id="mail-sender" name="mail-sender" class="form-control" size="70" value="[your-name] <wordpress@cig-marketing.com>">
                                             </div>
                                          </div>
                                          
                                          <div class="row">
                                             <div class="col-md-2">
                                                <label for="mail-subject">Subject</label>
                                             </div>
                                             <div class="col-md-10">
                                                <input type="text" id="mail-subject" name="mail-subject" class="form-control" size="70" value="CIG-Marketing &quot;[your-subject]&quot;">
                                             </div>
                                          </div>

                                          <div class="row">
                                             <div class="col-md-2">
                                                <label for="mail-additional-headers">Additional Headers</label>
                                             </div>
                                             <div class="col-md-10">
                                                <textarea id="mail-additional-headers" name="mail-additional-headers" cols="100" rows="4" class="form-control">Reply-To: [your-email]</textarea>
                                             </div>
                                          </div>

                                          <div class="row">
                                             <div class="col-md-2">
                                                <label for="mail-body">Message Body</label>
                                             </div>
                                             <div class="col-md-10">
                                                <textarea id="mail-body" name="mail-body" cols="100" rows="18" class="form-control">From: [your-name] &lt;[your-email]&gt;
                                                      Subject: [your-subject]

                                                      Message Body:
                                                      [your-message]

                                                      --
                                                      This e-mail was sent from a contact form on CIG-Marketing (http://cig-marketing.com)</textarea>
                                             </div>
                                          </div>

                                          <div class="row">
                                             <div class="col-md-2"></div>
                                             <div class="col-md-10">
                                               <label for="mail-exclude-blank"><input type="checkbox" id="mail-exclude-blank" name="mail-exclude-blank" value="1"> Exclude lines with blank mail-tags from output</label>
                                             </div>
                                          </div>

                                          <div class="row">
                                             <div class="col-md-2"></div>
                                             <div class="col-md-10">
                                                <label for="mail-use-html"><input type="checkbox" id="mail-use-html" name="mail-use-html" value="1"> Use HTML content type</label>
                                             </div>
                                          </div>

                                          <div class="row">
                                             <div class="col-md-2">
                                                <label for="mail-attachments">File Attachments</label>
                                             </div>
                                             <div class="col-md-10">
                                                <textarea id="mail-attachments" name="mail-attachments" cols="100" rows="4" class="form-control"></textarea>
                                             </div>
                                          </div>
                                      </div>

                                      <div class="tab-pane fade" id="messages">
                                          <h2>Messages</h2>
                                          Edit messages used in the following situations.
                                          <p class="description">
                                             <label for="message-mail-sent-ok">Sender's message was sent successfully<br>
                                             <input type="text" id="message-mail-sent-ok" name="message-mail-sent-ok" class="form-control" size="70" value="Thank you for your message. It has been sent.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-mail-sent-ng">Sender's message failed to send<br>
                                             <input type="text" id="message-mail-sent-ng" name="message-mail-sent-ng" class="form-control" size="70" value="There was an error trying to send your message. Please try again later.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-validation-error">Validation errors occurred<br>
                                             <input type="text" id="message-validation-error" name="message-validation-error" class="form-control" size="70" value="One or more fields have an error. Please check and try again.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-spam">Submission was referred to as spam<br>
                                             <input type="text" id="message-spam" name="message-spam" class="form-control" size="70" value="There was an error trying to send your message. Please try again later.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-accept-terms">There are terms that the sender must accept<br>
                                             <input type="text" id="message-accept-terms" name="message-accept-terms" class="form-control" size="70" value="You must accept the terms and conditions before sending your message.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-invalid-required">There is a field that the sender must fill in<br>
                                             <input type="text" id="message-invalid-required" name="message-invalid-required" class="form-control" size="70" value="The field is required.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-invalid-too-long">There is a field with input that is longer than the maximum allowed length<br>
                                             <input type="text" id="message-invalid-too-long" name="message-invalid-too-long" class="form-control" size="70" value="The field is too long.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-invalid-too-short">There is a field with input that is shorter than the minimum allowed length<br>
                                             <input type="text" id="message-invalid-too-short" name="message-invalid-too-short" class="form-control" size="70" value="The field is too short.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-invalid-date">Date format that the sender entered is invalid<br>
                                             <input type="text" id="message-invalid-date" name="message-invalid-date" class="form-control" size="70" value="The date format is incorrect.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-date-too-early">Date is earlier than minimum limit<br>
                                             <input type="text" id="message-date-too-early" name="message-date-too-early" class="form-control" size="70" value="The date is before the earliest one allowed.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-date-too-late">Date is later than maximum limit<br>
                                             <input type="text" id="message-date-too-late" name="message-date-too-late" class="form-control" size="70" value="The date is after the latest one allowed.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-upload-failed">Uploading a file fails for any reason<br>
                                             <input type="text" id="message-upload-failed" name="message-upload-failed" class="form-control" size="70" value="There was an unknown error uploading the file.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-upload-file-type-invalid">Uploaded file is not allowed for file type<br>
                                             <input type="text" id="message-upload-file-type-invalid" name="message-upload-file-type-invalid" class="form-control" size="70" value="You are not allowed to upload files of this type.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-upload-file-too-large">Uploaded file is too large<br>
                                             <input type="text" id="message-upload-file-too-large" name="message-upload-file-too-large" class="form-control" size="70" value="The file is too big.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-upload-failed-php-error">Uploading a file fails for PHP error<br>
                                             <input type="text" id="message-upload-failed-php-error" name="message-upload-failed-php-error" class="form-control" size="70" value="There was an error uploading the file.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-invalid-number">Number format that the sender entered is invalid<br>
                                             <input type="text" id="message-invalid-number" name="message-invalid-number" class="form-control" size="70" value="The number format is invalid.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-number-too-small">Number is smaller than minimum limit<br>
                                             <input type="text" id="message-number-too-small" name="message-number-too-small" class="form-control" size="70" value="The number is smaller than the minimum allowed.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-number-too-large">Number is larger than maximum limit<br>
                                             <input type="text" id="message-number-too-large" name="message-number-too-large" class="form-control" size="70" value="The number is larger than the maximum allowed.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-quiz-answer-not-correct">Sender doesn't enter the correct answer to the quiz<br>
                                             <input type="text" id="message-quiz-answer-not-correct" name="message-quiz-answer-not-correct" class="form-control" size="70" value="The answer to the quiz is incorrect.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-invalid-email">Email address that the sender entered is invalid<br>
                                             <input type="text" id="message-invalid-email" name="message-invalid-email" class="form-control" size="70" value="The e-mail address entered is invalid.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-invalid-url">URL that the sender entered is invalid<br>
                                             <input type="text" id="message-invalid-url" name="message-invalid-url" class="form-control" size="70" value="The URL is invalid.">
                                             </label>
                                          </p>
                                          <p class="description">
                                             <label for="message-invalid-tel">Telephone number that the sender entered is invalid<br>
                                             <input type="text" id="message-invalid-tel" name="message-invalid-tel" class="form-control" size="70" value="The telephone number is invalid.">
                                             </label>
                                          </p>
                                      </div>

                                      <div class="tab-pane fade" id="settings">
                                          You can add customization code snippets here. For details, see Additional Settings.
                                          <textarea id="additional-settings" name="additional-settings" cols="100" rows="8" class="form-control"></textarea>
                                      </div>
                                   </div>

                            <input type="submit" class="btn blue btn-sm" value="Save">
                                
                        </div>
                        <div class="col-md-4">
                            <div class="portlet box green-meadow">
                               <div class="portlet-title">
                                  <div class="caption">
                                     <i class="fa fa-paper-plane-o"></i>Status
                                  </div>
                                  <div class="tools">
                                     <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                     <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                  </div>
                               </div>
                               <div class="portlet-body"> 
                                    <div class="row">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6 right"><input type="submit" class="btn blue btn-sm" value="Save"></div>
                                    </div>  
                               </div>
                            </div>

                        </div>
                    </form>
                    <!-- END PAGE BASE CONTENT -->
                </div>
            </div>
                   
@stop
@section('scripts')

@stop