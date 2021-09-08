$(function () {
    var cy = cytoscape({
        container: document.getElementById('cy'),
        ready:function(){
            console.log("App Ready");
        },
        elements:{
            nodes:[
                {data:{id:"Client"}},
                {data:{id:"ProjectManager"}},
                {data:{id:"LeadProgrammer"}},
                {data:{id:"Programmer1"}},
                {data:{id:"Programmer2"}},
                {data:{id:"Programmer3"}},
                {data:{id:"Documenter"}}
            ],
            edges:[
                {data:{id:"e0",source:"Client",target:"ProjectManager"}},
                {data:{id:"e1",source:"ProjectManager",target:"LeadProgrammer"}},
                {data:{id:"e2",source:"LeadProgrammer",target:"Programmer1"}},
                {data:{id:"e3",source:"LeadProgrammer",target:"Programmer2"}},
                {data:{id:"e4",source:"LeadProgrammer",target:"Programmer3"}},
                {data:{id:"e5",source:"LeadProgrammer",target:"Documenter"}},
            ]
        },
        zoom:10,
        pan:{x:0,y:0},
        layout:{
            //name:"breadthfirst"
            //name:"preset"
            //name:"grid"
            name:"random"            
        },
        style:cytoscape.stylesheet()
            .selector('node')
            .css({
                "content":"data(id)",
                "background-image": 'url(http://puji.angin.com/cytoscape/data(id).jpg)',
                "background-fit": "cover"
            })
        });
});
