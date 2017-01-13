<script>
    (function($){
            $("head").append("<style>.test-container h3 {font-size:20px}; .test-container h4 {font-size:21px} .test-container {font-family:sans-serif;} .test-container table {border:solid 1px black;margin: 10px 0px;width:100%; max-width:1000px} .test-container tr {border: solid 0px black;border-top-width: 1px;border-bottom-width:1px;margin: 5px 0px} .test-container td,.test-container th {padding: 10px} .test-container button {width: 10em;height: 2.5em;font-size:24px;background-color:#4af;color:white} .test-container tr:nth-child(odd) {background-color:#eee;} .test-container button:disabled {opacity:0.25} .test-container td[data-highlighted],.test-container th[data-highlighted] {background-color:#4af;color:white;font-weight:bold} .test-container h1 {text-align:center}</style>");
        window.createTests = function(data) {
            var container = $(data.target);
            var table = $("<table></table>").appendTo(container);
            var tr = $("<tr></tr>").appendTo(table);
            var submit = $("<button>"+data.buttonText+"</button>").appendTo($("<div style='text-align:center'></div>").appendTo(container)).prop("disabled", true);
            var results = $("<div style='text-align:center; margin:20px;'></div>").appendTo(container);
            var scale = $("<div></div>").appendTo(container);
            tr.append("<th></th>").append("<th></th>");
            for(var c=0; c<data.columns.length; ++c) {
                tr.append("<th style='width:75px;font-size:12px'>"+data.columns[c][0]+"</th>");
            }
            for(var r=0; r<data.rows.length; ++r) {
                tr = $('<tr data-row="'+r+'"></tr>').appendTo(table);
                tr.append("<td>"+(r+1)+"</td>");
                tr.append("<td>"+data.rows[r]+"</td>");
                for(var c=0; c<data.columns.length; ++c) {
                    var td = $('<td style="text-align:center"></td>').appendTo(tr);
                    var rb = $('<input type="radio" data-score="'+data.columns[c][1]+'" data-row="'+r+'"></input>').appendTo(td);
                    rb.on("change", function() {
                        var self = $(this);
                        var row = table.find('input[data-row="'+self.data("row")+'"]');
                        for(var r=0; r<row.length; ++r) {
                            if(row[r] != this) {
                                $(row[r]).prop("checked",false);
                            }
                        }
                        table.find('tr[data-row="'+self.data("row")+'"]').attr("data-checked","true");
                        if(table.find("tr[data-checked]").length == data.rows.length && (!data.vanderbilt || table2.find("tr[data-checked]").length == data.vanderbilt.rows.length)) {
                            submit.prop("disabled", false);
                        }
                    });
                }
            }
            if(data.vanderbilt) {
                var vr = 0;
                submit.before("<h2>Performance:</h2>");
                var table2 = $("<table></table>").insertBefore(submit);
                var tr = $("<tr></tr>").appendTo(table2);
                tr.append("<th></th>").append("<th></th>");
                for(var c=0; c<data.vanderbilt.columns.length; ++c) {
                    tr.append("<th style='width:75px;font-size:12px'>"+data.vanderbilt.columns[c][0]+"</th>");
                }
                for(var r=0; r<data.vanderbilt.rows.length; ++r) {
                    vr = data.rows.length + r;
                    tr = $('<tr data-row="'+vr+'"></tr>').appendTo(table2);
                    tr.append("<td>"+(vr+1)+"</td>");
                    tr.append("<td>"+data.vanderbilt.rows[r]+"</td>");
                    for(var c=0; c<data.vanderbilt.columns.length; ++c) {
                        var td = $('<td style="text-align:center"></td>').appendTo(tr);
                        var rb = $('<input type="radio" data-score="'+data.vanderbilt.columns[c][1]+'" data-row="'+vr+'"></input>').appendTo(td);
                        rb.on("change", function() {
                            var self = $(this);
                            var row = table2.find('input[data-row="'+self.data("row")+'"]');
                            for(var r=0; r<row.length; ++r) {
                                if(row[r] != this) {
                                    $(row[r]).prop("checked",false);
                                }
                            }
                            table2.find('tr[data-row="'+self.data("row")+'"]').attr("data-checked","true");
                            if(table.find("tr[data-checked]").length == data.rows.length && table2.find("tr[data-checked]").length == data.vanderbilt.rows.length) {
                                submit.prop("disabled", false);
                            }
                       });
                   }
               }
               submit.on("click", function() {
                   var score_0_8 = 0, score_9_17 = 0, score_18_25 = 0, score_26_39 = 0, score_40_46 = 0, score_47_54 = 0;
                   submit.remove();
                   table.find('input[data-score]').each(function() {
                       var self = $(this);
                       if(self.is(":checked")) {
                           var self_score = parseInt(self.data("score"));
                           var self_row = parseInt(self.data("row"));
                           if(self_score >= 2) {
                               if(self_row >= 0 && self_row <= 8) score_0_8++;
                               if(self_row >= 9 && self_row <= 17) score_9_17++;
                               if(self_row >= 18 && self_row <= 25) score_18_25++;
                               if(self_row >= 26 && self_row <= 39) score_26_39++;
                               if(self_row >= 40 && self_row <= 46) score_40_46++;
                           }
                       }
                   });
                   table2.find('input[data-score]').each(function() {
                       var self = $(this);
                       if(self.is(":checked")) {
                           var self_score = parseInt(self.data("score"));
                           var self_row = parseInt(self.data("row"));
                           if(self_score >= 4) {
                               if(self_row >= 47 && self_row <= 54) score_47_54++;
                           }
                       }
                   });
                   var ADDHD = false, ADD = false, ADHD = false, ODD = false, CD = false, AD = false;
                   if(score_47_54 > 0) {
                       if(score_0_8 >= 6 && score_9_17 >= 6) ADDHD = true;
                       else if(score_0_8 >= 6) ADD = true;
                       else if(score_9_17 >= 6) ADHD = true;
                       if(score_18_25 >= 4) ODD = true;
                       if(score_26_39 >= 3) CD = true;
                       if(score_40_46 >= 4) AD = true;
                   }
                   results.html("");
                   if(ADD || ADHD || ADDHD || ODD || CD || AD) {
                       results.append("<h3>"+data.vanderbilt.tendencies+"</h3>")
                       if(ADD) results.append("<h4>"+data.vanderbilt.add+"</h4>");
                       if(ADHD) results.append("<h4>"+data.vanderbilt.adhd+"</h4>");
                       if(ADDHD) results.append("<h4>"+data.vanderbilt.addhd+"</h4>");
                       if(ODD) results.append("<h4>"+data.vanderbilt.odd+"</h4>");
                       if(CD) results.append("<h4>"+data.vanderbilt.cd+"</h4>");
                       if(AD) results.append("<h4>"+data.vanderbilt.ad+"</h4>");
                   } else {
                       results.append("<h3>"+data.vanderbilt.notendencies+"</h3>")
                   }
               });
            } else {
                var t = table;
                submit.on("click", function() {
                    var score = 0;
                    submit.remove();
                    var table = t;
                    table.find('input[data-score]').each(function() {
                        var self = $(this);
                        if(self.is(":checked")) {
                            score += parseInt(self.data("score"));
                        }
                    });
                    results.text("Score: " + score);
                    scale.html("");
                    if(scale.length > 0) {
                        var table = $("<table></table>").appendTo(scale);
                        var tr = $("<tr></tr>").appendTo(table);
                        var size = 100 / data.scale.length;
                        var highlighted = "";
                        for(var c=0; c<data.scale.length; ++c) {
                            if(score >= data.scale[c][0] && score <= data.scale[c][1]) highlighted = "data-highlighted='true'";
                            else highlighted = "";
                            tr.append("<th "+highlighted+" style='width:"+size+"%'>"+data.scale[c][0]+"-"+data.scale[c][1]+"</th>");
                        }
                        var tr = $("<tr></tr>").appendTo(table);
                        for(var c=0; c<data.scale.length; ++c) {
                            if(score >= data.scale[c][0] && score <= data.scale[c][1]) highlighted = "data-highlighted='true'";
                            else highlighted = "";
                            tr.append("<td "+highlighted+">"+data.scale[c][2]+"</td>");
                        }
                    }
                });
            }
        };
    })(jQuery);
</script>
<!-- ***************** TEST 1 **************** -->
<div id="test-1" class="test-container">
 <h1>Convergence Insufficiency Symptoms</h1>
</div>
<script>
    (function(){
        /* List of columns, each consisting of title and score multiplier */
        var columns = [
                       ["Never",0],
                       ["Not very often",1],
                       ["Sometimes",2],
                       ["Fairly often",3],
                       ["Always",4]
                      ];
        /* List of questions */
        var rows = [
                    "Do your eyes feel tired when reading or doing close work?",
                    "Do your eyes feel uncomfortable when reading or doing close work?",
                    "Do you have headaches when reading or doing close work?",
                    "Do you feel sleepy when reading or doing close work?",
                    "Do you lose concentration when reading or doing close work?",
                    "Do you have trouble remembering what you have read?",
                    "Do you have double vision when reading or doing close work?",
                    "Do you see the words move, jump, swim or appear to float on the page when reading or doing close work?",
                    "Do you feel like you read slowly?",
                    "Do your eyes ever hurt when reading or doing close work?",
                    "Do your eyes ever feel sore when reading or doing close work?",
                    "Do you feel a 'pulling' feeling around your eyes when reading or doing close work?",
                    "Do you notice the words blurring or coming in and out of focus when reading or doing close work?",
                    "Do you lose your place while reading or doing close work?",
                    "Do you have to re-read the same line of words when reading?"
                   ];
        /* Scale is a list in a format: [minimum score, maximum score, description] */
        var scale = [
                     [0,  10,   "Vision disorder is most likely not contributing to your reading problems. Please continue with assessments to identify other issues."],
                     [11, 16, "You have tendencies towards a vision disorder. We recommend you see a Developmental Optometrist for a Functional Vision Exam to see if a pair of glasses will help you when reading."],
                     [16, 60, "Your child most likely has a vision disorder called Convergency Insufficiency, the most common disorder that interferes with reading. "]
                    ];
        var buttonText = "Check Score";
        window.createTests({columns: columns, rows: rows, target: "#test-1", buttonText: buttonText, scale: scale});
    })();
</script>
