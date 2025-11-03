                  
                  <h5 class="section-subtitle"><b>Permanent Address</b></h5>
                    
                                 
                        <div class="form-group{{ $errors->has('division_id') ? ' has-error' : '' }}">
                            
                            
                        </div>
                        <div class="form-group{{ $errors->has('district_id') ? ' has-error' : '' }}">
                            
                        </div>
                        <div class="form-group{{ $errors->has('thana_id') ? ' has-error' : '' }}">
                          
                                    
                        </div>
                       

                        <div class="col-sm-4">
                            {{Form::textarea('present_address',null,array('class' => 'form-control max-length','rows' => 1, 'cols' => 2,'maxlength'=>'150'))}}
                              {!! $errors->first('present_address', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                      