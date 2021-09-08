<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('Superuser/head');?>
<body>
    <?php  $this->load->view('adm/header');?>
<div class="menu">                
        <div class="breadLine">            
            <div class="arrow"></div>
            <div class="adminControl active">
                Hi, Superuser
            </div>
        </div>
        <div class="admin">
            <div class="image">
                <img src="/asset/aqua/img/users/aqvatarius.jpg" class="img-polaroid"/>                
            </div>
            <ul class="control">                
                <li><span class="icon-comment"></span> <a href="messages.html">Messages</a> <a href="messages.html" class="caption red">12</a></li>
                <li><span class="icon-cog"></span> <a href="forms.html">Settings</a></li>
                <li><span class="icon-share-alt"></span> <a href="login.html">Logout</a></li>
            </ul>
            <div class="info">
                <span>Welcom back! Your last visit: 24.10.2012 in 19:55</span>
            </div>
        </div>
        <ul class="navigation">            
            <li>
                <a href="/">
                    <span class="isw-grid"></span><span class="text">Dashboard</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="content">
        <div class="breadLine">
            <ul class="breadcrumb">
                <li><a href="#">PadiApp</a> <span class="divider">></span></li>                
                <li class="active">Superuser</li>
            </ul>
            <ul class="buttons">
                <li>
                    <a href="#" class="link_bcPopupList"><span class="icon-user"></span><span class="text">Users list</span></a>

                    <div id="bcPopupList" class="popup">
                        <div class="head clearfix">
                            <div class="arrow"></div>
                            <span class="isw-users"></span>
                            <span class="name">List users</span>
                        </div>
                        <div class="body-fluid users">

                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="/asset/aqua/img/users/aqvatarius_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Aqvatarius</a>                                    
                                    <span>online</span>
                                </div>
                            </div>

                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="/asset/aqua/img/users/olga_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Olga</a>                                
                                    <span>online</span>
                                </div>
                            </div>                        

                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="/asset/aqua/img/users/alexey_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Alexey</a>  
                                    <span>online</span>
                                </div>
                            </div>                              
                        
                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="/asset/aqua/img/users/dmitry_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Dmitry</a>                                    
                                    <span>online</span>
                                </div>
                            </div>                         

                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="/asset/aqua/img/users/helen_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Helen</a>                                                                        
                                </div>
                            </div>                                  

                            <div class="item clearfix">
                                <div class="image"><a href="#"><img src="/asset/aqua/img/users/alexander_s.jpg" width="32"/></a></div>
                                <div class="info">
                                    <a href="#" class="name">Alexander</a>                                                                        
                                </div>
                            </div>                                  

                        </div>
                        <div class="footer">
                            <button class="btn" type="button">Add new</button>
                            <button class="btn btn-danger link_bcPopupList" type="button">Close</button>
                        </div>
                    </div>                    
                    
                </li>                
                <li>
                    <a href="#" class="link_bcPopupSearch"><span class="icon-search"></span><span class="text">Search</span></a>
                    
                    <div id="bcPopupSearch" class="popup">
                        <div class="head clearfix">
                            <div class="arrow"></div>
                            <span class="isw-zoom"></span>
                            <span class="name">Search</span>
                        </div>
                        <div class="body search">
                            <input type="text" placeholder="Some text for search..." name="search"/>
                        </div>
                        <div class="footer">
                            <button class="btn" type="button">Search</button>
                            <button class="btn btn-danger link_bcPopupSearch" type="button">Close</button>
                        </div>
                    </div>                
                </li>
            </ul>
        </div>
        <div class="workplace">
            <div class="row-fluid">                
                <div class="span6">
                    <div class="head clearfix">
                        <div class="isw-grid"></div>
                        <h1>App Shortcuts</h1>
                    </div>
                    <div class="block">
                        <div class="row-form clearfix">                            
                            <div class="span3">TS</div>
                            <div class="span9">
                                <p>
                                    <button class="btn" type="button">Tickets</button>                                
                                    <button class="btn btn-primary" type="button">Troubleshoot</button>
                                    <button class="btn btn-info" type="button">Survey</button>                                
                                    <button class="btn btn-success" type="button">Installs</button>
                                </p>
                                <p>
                                    <button class="btn btn-warning" type="button">Warning button</button>                                
                                    <button class="btn btn-danger" type="button">Danger button</button>
                                    <button class="btn btn-inverse" type="button">Inverse button</button>                                
                                    <button class="btn btn-link" type="button">Link button</button>                                
                                </p>                                                            
                            </div>                            
                        </div>                                                
                        
                        <div class="row-form clearfix">
                            <div class="span3">Sales</div>
                            <div class="span3">
                                <button class="btn btn-block" type="button">Suspect</button>
                            </div>
                            <div class="span3">
                                <button class="btn btn-block btn-warning" type="button">Prospect</button>
                            </div>                                
                            <div class="span3">
                                <button class="btn btn-block btn-danger" type="button">Survey</button>
                            </div>                                                        
                        </div>                          
                        
                        <div class="row-form clearfix">                            
                            <div class="span3">Sizes</div>
                            <div class="span9">
                                <p>                                                      
                                    <button class="btn btn-large" type="button">Large button</button>
                                    <button class="btn btn-large btn-warning" type="button">Large button</button>
                                </p>
                                <p>
                                    <button class="btn" type="button">Default button</button>
                                    <button class="btn btn-warning" type="button">Default button</button>
                                </p>
                                <p>
                                    <button class="btn btn-small" type="button">Small button</button>
                                    <button class="btn btn-small btn-warning" type="button">Small button</button>
                                </p>
                                <p>
                                    <button class="btn btn-mini" type="button">Mini button</button>
                                    <button class="btn btn-mini btn-warning" type="button">Mini button</button>
                                </p>                            
                            </div>                            
                        </div>                          
                        
                    </div>
                </div>                                
                
                
                <div class="span6">
                    <div class="head clearfix">
                        <div class="isw-documents"></div>
                        <h1>Administrating</h1>
                    </div>
                    <div class="block">
                        
                        <div class="row-form clearfix">
                            <div class="span3">Single button group</div>
                            <div class="span9">
                                
                                <div class="btn-group">
                                    <button class="btn" type="button">1</button>
                                    <button class="btn" type="button">2</button>
                                    <button class="btn" type="button">3</button>
                                    <button class="btn" type="button">4</button>
                                    <button class="btn" type="button">5</button>
                                    <button class="btn" type="button">6</button>
                                </div>                                
                                
                            </div>
                        </div>


                        <div class="row-form clearfix">
                            <div class="span3">Multiple button groups</div>
                            <div class="span9">
                                
                                <div class="btn-toolbar">
                                    
                                    <div class="btn-group">
                                        <button class="btn" type="button">1</button>
                                        <button class="btn" type="button">2</button>
                                        <button class="btn" type="button">3</button>
                                    </div>                                                                

                                    <div class="btn-group">
                                        <button class="btn" type="button">4</button>
                                        <button class="btn" type="button">5</button>
                                        <button class="btn" type="button">6</button>
                                    </div>                                    
                                    
                                </div>                                                                                                
                                
                            </div>
                        </div>                        

                        <div class="row-form clearfix">
                            <div class="span3">Vertical button groups</div>
                            <div class="span9">
                                
                                <div class="btn-toolbar">
                                    
                                    <div class="btn-group btn-group-vertical">
                                        <button class="btn" type="button">1</button>
                                        <button class="btn" type="button">4</button>
                                        <button class="btn" type="button">7</button>                                        
                                    </div> 
                                    
                                    <div class="btn-group btn-group-vertical">                                        
                                        <button class="btn" type="button">2</button>
                                        <button class="btn" type="button">5</button>
                                        <button class="btn" type="button">8</button>
                                    </div> 

                                    <div class="btn-group btn-group-vertical">                                        
                                        <button class="btn" type="button">3</button>
                                        <button class="btn" type="button">6</button>
                                        <button class="btn" type="button">9</button>
                                    </div>                                     
                                    
                                </div>                                                                                                
                                
                            </div>
                        </div>                         

                        <div class="row-form clearfix">
                            <div class="span3">Button dropdown menus</div>
                            <div class="span9">
                                
                                <div class="btn-toolbar">
                                    
                                    <div class="btn-group">                                        
                                        <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>
                                    
                                    <div class="btn-group">                                        
                                        <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Action <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>                                    
                                    
                                </div>                                                                                                
                                
                            </div>
                        </div>                          
                        
                    </div>                    
                </div>                
                
                
            </div>            
            
            <div class="dr"><span></span></div>
        
            <div class="row-fluid">                
                
                <div class="span6">
                    <div class="head clearfix">
                        <div class="isw-cloud"></div>
                        <h1>Bootstrap buttons plugin</h1>
                    </div>
                    <div class="block">
                        
                        <div class="row-form clearfix">
                            <div class="span3">Single toggle</div>
                            <div class="span9">                                
                                <button type="button" class="btn" data-toggle="button">Single Toggle</button>                                                            
                            </div>
                        </div>                                            
                        
                        <div class="row-form clearfix">
                            <div class="span3">Checkbox</div>
                            <div class="span9">                                
                                
                                <div class="btn-group" data-toggle="buttons-checkbox">
                                    <button type="button" class="btn">Left</button>
                                    <button type="button" class="btn">Middle</button>
                                    <button type="button" class="btn">Right</button>
                                </div>                                
                                
                            </div>
                        </div>                                            
                        
                        <div class="row-form clearfix">
                            <div class="span3">Radio</div>
                            <div class="span9">                                
                                
                                <div class="btn-group" data-toggle="buttons-radio">
                                    <button type="button" class="btn">Left</button>
                                    <button type="button" class="btn">Middle</button>
                                    <button type="button" class="btn">Right</button>
                                </div>
                                
                            </div>
                        </div>                                            
                        
                    </div>                    
                </div>                                
                
            </div>            
            
            
        </div>
        
    </div>   
    
</body>
</html>
