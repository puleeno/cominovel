(this.webpackJsonpcominovel=this.webpackJsonpcominovel||[]).push([[0],{21:function(e,t,n){Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var a=function(e){if(e&&e.__esModule)return e;var t=f();if(t&&t.has(e))return t.get(e);var n={};if(null!=e){var a=Object.defineProperty&&Object.getOwnPropertyDescriptor;for(var r in e)if(Object.prototype.hasOwnProperty.call(e,r)){var o=a?Object.getOwnPropertyDescriptor(e,r):null;o&&(o.get||o.set)?Object.defineProperty(n,r,o):n[r]=e[r]}}n.default=e,t&&t.set(e,n);return n}(n(1)),r=d(n(2)),o=d(n(261)),c=d(n(198)),l=d(n(17)),i=n(86),s=(n(166),d(n(98))),u=d(n(361)),p=n(212),m=d(n(213));function d(e){return e&&e.__esModule?e:{default:e}}function f(){if("function"!==typeof WeakMap)return null;var e=new WeakMap;return f=function(){return e},e}function h(e){return(h="function"===typeof Symbol&&"symbol"===typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"===typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function y(){return(y=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var a in n)Object.prototype.hasOwnProperty.call(n,a)&&(e[a]=n[a])}return e}).apply(this,arguments)}function v(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function b(e,t){for(var n=0;n<t.length;n++){var a=t[n];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(e,a.key,a)}}function O(e,t){return!t||"object"!==h(t)&&"function"!==typeof t?function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e):t}function g(e){return(g=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function E(e,t){return(E=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}var j=function(e){function t(e){var n;return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t),(n=O(this,g(t).call(this,e))).renderForm=function(e){var t,o=e.getPrefixCls,c=n.props,i=c.prefixCls,s=c.hideRequiredMark,u=c.className,p=void 0===u?"":u,m=c.layout,d=o("form",i),f=(0,r.default)(d,(v(t={},"".concat(d,"-horizontal"),"horizontal"===m),v(t,"".concat(d,"-vertical"),"vertical"===m),v(t,"".concat(d,"-inline"),"inline"===m),v(t,"".concat(d,"-hide-required-mark"),s),t),p),h=(0,l.default)(n.props,["prefixCls","className","layout","form","hideRequiredMark","wrapperCol","labelAlign","labelCol","colon"]);return a.createElement("div",y({},h,{className:f}))},(0,s.default)(!e.form,"Form","It is unnecessary to pass `form` to `Form` after antd@1.7.0."),n}var n,o,c;return function(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&E(e,t)}(t,e),n=t,(o=[{key:"render",value:function(){var e=this.props,t=e.wrapperCol,n=e.labelAlign,r=e.labelCol,o=e.layout,c=e.colon;return a.createElement(m.default.Provider,{value:{wrapperCol:t,labelAlign:n,labelCol:r,vertical:"vertical"===o,colon:c}},a.createElement(i.ConfigConsumer,null,this.renderForm))}}])&&b(n.prototype,o),c&&b(n,c),t}(a.Component);t.default=j,j.defaultProps={colon:!0,layout:"horizontal",hideRequiredMark:!1,onSubmit:function(e){e.preventDefault()}},j.Item=u.default,j.createFormField=c.default,j.create=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return(0,o.default)(y(y({fieldNameProp:"id"},e),{fieldMetaProp:p.FIELD_META_PROP,fieldDataProp:p.FIELD_DATA_PROP}))}},250:function(e,t,n){e.exports=n(481)},260:function(e,t,n){},481:function(e,t,n){"use strict";n.r(t);var a=n(1),r=n.n(a),o=n(10),c=n.n(o),l=n(36),i=n(488),s=n(22),u=n(23),p=n(25),m=n(24),d=n(26),f=n(489),h=n(242),y=n(30),v="FETCH_COMINOVEL",b="FETCH_COMINOVEL_FULLFILLED",O="FETCH_SEASONS",g="FETCH_SEASONS_FULLFILLED",E="FETCH_TAXONOMY_TERMS",j="FETCH_TAXONOMY_TERMS_FULLFILLED";function C(e){return{payload:e,type:v}}function w(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"genre";return{keyword:arguments.length>1&&void 0!==arguments[1]?arguments[1]:null,taxonomy:e,treeView:arguments.length>2&&void 0!==arguments[2]&&arguments[2],type:E}}function _(e){return{payload:e,type:O}}n(259),n(260);var k=function(){function e(){Object(s.a)(this,e)}return Object(u.a)(e,null,[{key:"bootstrap",value:function(){window.Cominovel=window.Cominovel||{},window.Cominovel.currentID=window.Cominovel.currentID||14395}}]),e}(),S=n(491),A=n(90),P=n(493),I=n(494),D=n(21),T=n.n(D),x=function(e){function t(){return Object(s.a)(this,t),Object(p.a)(this,Object(m.a)(t).apply(this,arguments))}return Object(d.a)(t,e),Object(u.a)(t,[{key:"render",value:function(){return r.a.createElement("div",{className:"cominovel-tab-content"},r.a.createElement(S.a,{title:"Advanced",subTitle:"C\xe1c th\xf4ng tin n\xe2ng cao"}),r.a.createElement(T.a,Object.assign({},{labelCol:{span:6},wrapperCol:{span:14}},{labelAlign:"left"}),r.a.createElement(T.a.Item,{label:"Adult content"},r.a.createElement(A.a.Group,{style:{width:"100%"},name:"rating_system"},r.a.createElement(P.a,null,r.a.createElement(I.a,{span:8},r.a.createElement(A.a,{value:"X"},"Include")))),",")))}}]),t}(a.Component),F=n(50),N=n(490),L=n(105),M=function(e){var t=[];return e.forEach((function(e){t.push(e.id)})),t},G=T.a.Item,B=function(e){function t(){var e,n;Object(s.a)(this,t);for(var a=arguments.length,r=new Array(a),o=0;o<a;o++)r[o]=arguments[o];return(n=Object(p.a)(this,(e=Object(m.a)(t)).call.apply(e,[this].concat(r)))).state={selectedArtists:n.props.selectedArtists},n.handleChange=function(e){n.setState({selectedArtists:[e]})},n}return Object(d.a)(t,e),Object(u.a)(t,[{key:"componentDidMount",value:function(){this.props.fetchTaxonomyTerms("cmn_artist")}},{key:"UNSAFE_componentWillReceiveProps",value:function(e){e.selectedArtists!==this.props.selectedArtists&&this.setState({selectedArtists:e.selectedArtists})}},{key:"renderItemKey",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"artist";return"".concat(t).concat(e)}},{key:"renderCominovelArtists",value:function(){var e=this;return"object"===typeof this.props.artists?this.props.artists.map((function(t,n){return r.a.createElement(L.a.Option,{key:e.renderItemKey(n,"artist_option"),value:t.id},t.name)})):null}},{key:"renderSelectedArtist",value:function(){var e=this;return this.state.selectedArtists.map((function(t,n){return r.a.createElement(N.a,{key:e.renderItemKey(n,"artist_option"),type:"hidden",name:"tax_input[cmn_artist][]",value:t})}))}},{key:"render",value:function(){return r.a.createElement(G,{label:"Artists"},r.a.createElement(L.a,{showSearch:!0,optionFilterProp:"children",placeholder:"Ti\u1ec3u T\xf4n Tuy\u1ebft \u0110\u0103ng",style:{width:"100%"},onChange:this.handleChange,value:this.state.selectedArtists[0]||void 0},this.renderCominovelArtists()),this.renderSelectedArtist())}}]),t}(a.Component),R=Object(l.b)((function(e){return{artists:e.terms.cmn_artist||[],selectedArtists:M(e.cominovel.info.cmn_artist_terms||[])}}),(function(e){return Object(y.b)({fetchTaxonomyTerms:w},e)}))(B),U=function(e){function t(){var e,n;Object(s.a)(this,t);for(var a=arguments.length,r=new Array(a),o=0;o<a;o++)r[o]=arguments[o];return(n=Object(p.a)(this,(e=Object(m.a)(t)).call.apply(e,[this].concat(r)))).state={selectedAuthors:n.props.selectedAuthors},n.handlerChange=function(e){n.setState({selectedAuthors:[e]})},n}return Object(d.a)(t,e),Object(u.a)(t,[{key:"componentDidMount",value:function(){this.props.fetchTaxonomyTerms("cmn_author")}},{key:"UNSAFE_componentWillReceiveProps",value:function(e){e.selectedAuthors!==this.props.selectedAuthors&&this.setState({selectedAuthors:e.selectedAuthors})}},{key:"renderItemKey",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"author";return"".concat(t).concat(e)}},{key:"renderCominovelAuthors",value:function(){var e=this;return"object"===typeof this.props.authors?this.props.authors.map((function(t,n){return r.a.createElement(L.a.Option,{key:e.renderItemKey(n),value:t.id},t.name)})):null}},{key:"renderSelectedAuthors",value:function(){var e=this;return this.state.selectedAuthors.map((function(t,n){return r.a.createElement(N.a,{type:"hidden",key:e.renderItemKey(n,"author_option"),name:"tax_input[cmn_author][]",value:t})}))}},{key:"render",value:function(){return r.a.createElement(T.a.Item,{label:"Authors"},r.a.createElement(L.a,{placeholder:"Choose or add author",style:{width:"100%"},value:this.state.selectedAuthors[0],onChange:this.handlerChange},this.renderCominovelAuthors()),this.renderSelectedAuthors())}}]),t}(a.Component),K=Object(l.b)((function(e){return{authors:e.terms.cmn_author||[],selectedAuthors:M(e.cominovel.info.cmn_author_terms||[])}}),(function(e){return Object(y.b)({fetchTaxonomyTerms:w},e)}))(U),V=function(e){function t(){var e,n;Object(s.a)(this,t);for(var a=arguments.length,r=new Array(a),o=0;o<a;o++)r[o]=arguments[o];return(n=Object(p.a)(this,(e=Object(m.a)(t)).call.apply(e,[this].concat(r)))).state={selectedCountries:n.props.selectedCountries},n.handleChange=function(e){n.setState({selectedCountries:[e]})},n}return Object(d.a)(t,e),Object(u.a)(t,[{key:"componentDidMount",value:function(){this.props.fetchTaxonomyTerms("cmn_country")}},{key:"UNSAFE_componentWillReceiveProps",value:function(e){e.selectedCountries!==this.props.selectedCountries&&this.setState({selectedCountries:e.selectedCountries})}},{key:"renderItemKey",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"country";return"".concat(t).concat(e)}},{key:"renderCominovelCountries",value:function(){var e=this;return"object"===typeof this.props.countries?this.props.countries.map((function(t,n){return r.a.createElement(L.a.Option,{key:e.renderItemKey(n),value:t.id},t.name)})):null}},{key:"renderSelectedCountries",value:function(){var e=this;return this.state.selectedCountries.map((function(t,n){return r.a.createElement(N.a,{type:"hidden",key:e.renderItemKey(n,"country_value"),name:"tax_input[cmn_country][]",value:t})}))}},{key:"render",value:function(){return r.a.createElement(T.a.Item,{label:"Comic Type"},r.a.createElement(L.a,{placeholder:"Country or comic types",style:{width:200},value:this.state.selectedCountries[0]||void 0,onChange:this.handleChange},this.renderCominovelCountries()),this.renderSelectedCountries())}}]),t}(a.Component),W=Object(l.b)((function(e){return{countries:e.terms.cmn_country||[],selectedCountries:M(e.cominovel.info.cmn_country_terms||[])}}),(function(e){return Object(y.b)({fetchTaxonomyTerms:w},e)}))(V),J=T.a.Item,q=function(e){function t(){var e,n;Object(s.a)(this,t);for(var a=arguments.length,r=new Array(a),o=0;o<a;o++)r[o]=arguments[o];return(n=Object(p.a)(this,(e=Object(m.a)(t)).call.apply(e,[this].concat(r)))).state={selectedGenres:n.props.selectedGenres},n.handleChange=function(e){n.setState({selectedGenres:[e]})},n}return Object(d.a)(t,e),Object(u.a)(t,[{key:"componentDidMount",value:function(){this.props.fetchTaxonomyTerms("genre",null,!0)}},{key:"UNSAFE_componentWillReceiveProps",value:function(e){e.selectedGenres!==this.props.selectedGenres&&this.setState({selectedGenres:e.selectedGenres})}},{key:"renderItemKey",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"genre";return"".concat(t).concat(e)}},{key:"renderSelectedGenres",value:function(){var e=this;return this.state.selectedGenres.map((function(t,n){return r.a.createElement(N.a,{type:"hidden",key:e.renderItemKey(n,"genre_option"),name:"tax_input[genre][]",value:t})}))}},{key:"renderCominovelGenres",value:function(){var e=this;return"object"===typeof this.props.genres?this.props.genres.map((function(t,n){return r.a.createElement(L.a.Option,{key:e.renderItemKey(n),value:t.id},t.name)})):null}},{key:"render",value:function(){return r.a.createElement(J,{label:"Genres"},r.a.createElement(L.a,{showSearch:!0,optionFilterProp:"children",placeholder:"The genre of comic",style:{width:200},onChange:this.handleChange,value:this.state.selectedGenres[0]||void 0},this.renderCominovelGenres()),this.renderSelectedGenres())}}]),t}(a.Component),H=Object(l.b)((function(e){return{genres:e.terms.genre||[],selectedGenres:M(e.cominovel.info.genre_terms)||[]}}),(function(e){return Object(y.b)({fetchTaxonomyTerms:w},e)}))(q),z=n(485),X=function(e){function t(){return Object(s.a)(this,t),Object(p.a)(this,Object(m.a)(t).apply(this,arguments))}return Object(d.a)(t,e),Object(u.a)(t,[{key:"renderFooter",value:function(){}},{key:"render",value:function(){return r.a.createElement(T.a.Item,{label:"Publish Date"},r.a.createElement(z.a,{placeholder:"Select publish date",mode:"year",style:{width:200}}))}}]),t}(a.Component),Y=Object(l.b)((function(e){return{release:e.cominovel.info.cmn_release_terms}}))(X);function Z(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}var $=T.a.Item,Q=N.a.TextArea,ee={labelCol:{sm:{span:5},xs:{span:24}},wrapperCol:{sm:{span:12},xs:{span:24}}},te=function(e){function t(e){var n;return Object(s.a)(this,t),(n=Object(p.a)(this,Object(m.a)(t).call(this,e))).state=e.info,n}return Object(d.a)(t,e),Object(u.a)(t,[{key:"UNSAFE_componentWillReceiveProps",value:function(e){this.props.info!==e.info&&this.setState(e.info)}},{key:"render",value:function(){var e=this;return r.a.createElement("div",{className:"cominovel-tab-content"},r.a.createElement(S.a,{title:"Basic Info",subTitle:"\u0110\xe2y l\xe0 c\xe1c th\xf4ng tin c\u01a1 b\u1ea3n c\u1ee7a truy\u1ec7n"}),r.a.createElement(T.a,Object.assign({},ee,{labelAlign:"left"}),r.a.createElement(N.a,{name:"cominovel_loaded",hidden:!0,value:"true"}),r.a.createElement($,{label:"Alternatve Name"},r.a.createElement(N.a,{name:"alternative_name",onChange:function(t){return e.setState({alternative_name:t.target.value})},value:this.state.alternative_name})),r.a.createElement(W,null),r.a.createElement(Y,null),r.a.createElement(K,null),r.a.createElement(R,null),r.a.createElement(H,null),r.a.createElement($,{label:"Short Description"},r.a.createElement(Q,{name:"post_excerpt",onChange:function(t){return e.setState({post_excerpt:t.target.value})},rows:4,value:this.state.post_excerpt}))))}}]),t}(a.Component),ne=Object(l.b)((function(e){return function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?Z(n,!0).forEach((function(t){Object(F.a)(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):Z(n).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({},e.terms,{info:e.cominovel.info})}),(function(e){return Object(y.b)({fetchTaxonomyTerms:w},e)}))(te),ae=n(93),re=n(8),oe=n(484),ce=n(487),le=function(e){function t(){return Object(s.a)(this,t),Object(p.a)(this,Object(m.a)(t).apply(this,arguments))}return Object(d.a)(t,e),Object(u.a)(t,[{key:"render",value:function(){return r.a.createElement("div",{className:"cominovel-tab-content"},r.a.createElement(S.a,{title:"Chapters",subTitle:"Danh s\xe1ch c\xe1c chapter hi\u1ec7n t\u1ea1i \u0111ang c\xf3",extra:[r.a.createElement(ae.a,null,r.a.createElement(re.a,{type:"plus"}),"New Chapter")]}),r.a.createElement(oe.a,{columns:ie,dataSource:se}))}}]),t}(a.Component),ie=[{dataIndex:"no",editable:!0,render:function(e){return r.a.createElement("span",null,e)},title:"No."},{dataIndex:"thumbnail",render:function(e){var t=r.a.createElement("div",null,r.a.createElement(re.a,{type:"plus"}),r.a.createElement("div",{className:"ant-upload-text"},"Upload"));return r.a.createElement(ce.a,{name:"avatar",listType:"picture-card",className:"avatar-uploader",showUploadList:!1,action:"https://www.mocky.io/v2/5cc8019d300000980a055e76"},t)},title:"Thumbnail"},{dataIndex:"name",editable:!0,title:"Name"},{dataIndex:"season",render:function(){return r.a.createElement("span",null,"Vol 1")},title:"Season"},{dataIndex:"createdAt",title:"Upload Date"},{render:function(e,t){return r.a.createElement("div",null,r.a.createElement("a",{href:"/wp-admin/post.php?post=14290&action=edit"},r.a.createElement(ae.a,{icon:"edit",style:{marginRight:10}})),r.a.createElement(ae.a,{type:"danger",icon:"delete"}))},title:"Action"}],se=[{author:"Puleeno Nguyen",createdAt:"2019-09-09 10:00",name:"John Brown",no:1,season:"Season 1",thumbnail:""},{author:"Puleeno Nguyen",createdAt:"2019-09-09 10:00",name:"Jim Green",no:2,season:"Season 2",thumbnail:""},{author:"Puleeno Nguyen",createdAt:"2019-09-09 10:00",name:"Joe Black",no:3,season:"Season 3",thumbnail:""}],ue=n(143),pe=function(e){function t(){var e,n;Object(s.a)(this,t);for(var a=arguments.length,r=new Array(a),o=0;o<a;o++)r[o]=arguments[o];return(n=Object(p.a)(this,(e=Object(m.a)(t)).call.apply(e,[this].concat(r)))).handleSubmit=function(e){e.preventDefault(),n.props.form.validateFields((function(e,t){e||console.log("Received values of form: ",t)}))},n.normFile=function(e){return console.log("Upload event:",e),Array.isArray(e)?e:e&&e.fileList},n}return Object(d.a)(t,e),Object(u.a)(t,[{key:"render",value:function(){var e=this.props.form.getFieldDecorator;return r.a.createElement("div",{className:"cominovel-tab-content"},r.a.createElement(S.a,{title:"Composer",subTitle:"Tr\xecnh bi\xean so\u1ea1n chapter cho truy\u1ec7n"}),r.a.createElement(T.a,Object.assign({},{labelCol:{span:6},wrapperCol:{span:14}},{labelAlign:"left"}),r.a.createElement(T.a.Item,{label:"Cloud Storage"},e("checkbox-group",{initialValue:["A","B"]})(r.a.createElement(A.a.Group,{style:{width:"100%"}},r.a.createElement(P.a,null,r.a.createElement(I.a,{span:8},r.a.createElement(A.a,{value:"A"},"A")),r.a.createElement(I.a,{span:8},r.a.createElement(A.a,{disabled:!0,value:"B"},"B")),r.a.createElement(I.a,{span:8},r.a.createElement(A.a,{value:"C"},"C")),r.a.createElement(I.a,{span:8},r.a.createElement(A.a,{value:"D"},"D")),r.a.createElement(I.a,{span:8},r.a.createElement(A.a,{value:"E"},"E")))))),r.a.createElement(T.a.Item,{label:"Season"},r.a.createElement(L.a,{showSearch:!0,style:{width:200},placeholder:"Select comic type",optionFilterProp:"children",filterOption:function(e,t){return t.props.children.toLowerCase().indexOf(e.toLowerCase())>=0}},r.a.createElement(L.a.Option,{value:"manga"},"Manga"),r.a.createElement(L.a.Option,{value:"manhua"},"Manhua"),r.a.createElement(L.a.Option,{value:"manhwa"},"Manhwa"))),r.a.createElement(T.a.Item,{label:"ZIP Mode"},e("radio-button")(r.a.createElement(ue.a.Group,null,r.a.createElement(ue.a.Button,{value:"a"},"Auto"),r.a.createElement(ue.a.Button,{value:"c"},"Single Chapter"),r.a.createElement(ue.a.Button,{value:"b"},"Multi Chapter")))),r.a.createElement(T.a.Item,{label:"Upload"},e("dragger",{valuePropName:"fileList",getValueFromEvent:this.normFile})(r.a.createElement(ce.a.Dragger,{name:"files",action:"/upload.do"},r.a.createElement("p",{className:"ant-upload-drag-icon"},r.a.createElement(re.a,{type:"inbox"})),r.a.createElement("p",{className:"ant-upload-text"},"Click or drag file to this area to upload"),r.a.createElement("p",{className:"ant-upload-hint"},"Support for a single or bulk upload.")))),r.a.createElement(T.a.Item,{wrapperCol:{span:12,offset:6}},r.a.createElement(ae.a,{type:"primary",htmlType:"submit"},"Compose"))))}}]),t}(a.Component),me=T.a.create({name:"validate_other"})(pe),de=0,fe={labelCol:{sm:{span:5},xs:{span:24}},wrapperCol:{sm:{span:12},xs:{span:24}}},he=function(e){function t(){var e,n;Object(s.a)(this,t);for(var a=arguments.length,r=new Array(a),o=0;o<a;o++)r[o]=arguments[o];return(n=Object(p.a)(this,(e=Object(m.a)(t)).call.apply(e,[this].concat(r)))).remove=function(e){var t=n.props.form,a=t.getFieldValue("keys");1!==a.length&&t.setFieldsValue({keys:a.filter((function(t){return t!==e}))})},n.add=function(){var e=n.props.form,t=e.getFieldValue("keys").concat(de++);e.setFieldsValue({keys:t})},n.saveSeason=function(){},n}return Object(d.a)(t,e),Object(u.a)(t,[{key:"componentDidMount",value:function(){this.props.fetchSeasons(window.Cominovel.currentID)}},{key:"renderSeasons",value:function(){var e=this,t=this.props.form,n=t.getFieldDecorator,a=t.getFieldValue;n("keys",{initialValue:[]});var o=a("keys");return o.map((function(t,a){return r.a.createElement(T.a.Item,Object.assign({},fe,{label:"Seasons ".concat(a+1),required:!1,key:t}),n("names[".concat(t,"]"),{rules:[{message:"Please input season name or delete this field.",required:!0,whitespace:!0}],validateTrigger:["onChange","onBlur"]})(r.a.createElement(N.a,{placeholder:"Season name",style:{width:"60%",marginRight:8}})),o.length>1?r.a.createElement(re.a,{className:"dynamic-delete-button",type:"minus-circle-o",onClick:function(){return e.remove(t)}}):null)}))}},{key:"render",value:function(){return r.a.createElement("div",{className:"cominovel-tab-content"},r.a.createElement(S.a,{title:"Seasons",subTitle:"Bi\xean so\u1ea1n season cho truy\u1ec7n"}),r.a.createElement(T.a,Object.assign({},fe,{labelAlign:"left"}),this.renderSeasons(),r.a.createElement(T.a.Item,null,r.a.createElement(ae.a,{type:"dashed",onClick:this.add,style:{width:"60%"}},r.a.createElement(re.a,{type:"plus"})," Add New Season")),r.a.createElement(T.a.Item,null,r.a.createElement(ae.a,{size:"large",type:"primary",htmlType:"submit",onClick:this.saveSeason},"Save"))))}}]),t}(a.Component),ye=T.a.create({name:"dynamic_form_item"})(he),ve=Object(l.b)((function(e){return{seasons:e.seasons}}),(function(e){return Object(y.b)({fetchSeasons:_},e)}))(ye),be=f.a.TabPane,Oe={chapterLoaded:!1,seasonLoaded:!1},ge=function(e){function t(){var e,n;Object(s.a)(this,t);for(var a=arguments.length,o=new Array(a),c=0;c<a;c++)o[c]=arguments[c];return(n=Object(p.a)(this,(e=Object(m.a)(t)).call.apply(e,[this].concat(o)))).state=Oe,n.handleModeChange=function(e){"season"===e&&n.setState({seasonLoaded:!0}),"chapter"===e&&n.setState({chapterLoaded:!0})},n.renderBasicInfos=function(){return r.a.createElement(be,{tab:"Basic Info",key:"basic"},r.a.createElement(ne,null))},n.renderChapters=function(){return r.a.createElement(be,{tab:"Chapters",key:"chapter"},n.state.chapterLoaded?r.a.createElement(le,null):null)},n.renderSeasons=function(){return r.a.createElement(be,{tab:"Seasons",key:"season"},n.state.seasonLoaded?r.a.createElement(ve,null):null)},n.renderAdvanced=function(){return r.a.createElement(be,{tab:"Advanced",key:"advanced"},r.a.createElement(x,null))},n.renderComposer=function(){return r.a.createElement(be,{tab:"Composer",key:"composer"},r.a.createElement(me,null))},n}return Object(d.a)(t,e),Object(u.a)(t,[{key:"UNSAFE_componentWillMount",value:function(){k.bootstrap()}},{key:"componentDidMount",value:function(){void 0!==typeof window.Cominovel.currentID&&this.props.fetchCominovel(window.Cominovel.currentID)}},{key:"render",value:function(){return null===this.props.isLoaded?r.a.createElement("div",{className:"cominovel-loading"},r.a.createElement(h.a,{size:"large"})):r.a.createElement(f.a,{defaultActiveKey:"1",tabPosition:"left",type:"card",onChange:this.handleModeChange},this.renderBasicInfos(),this.renderChapters(),this.renderSeasons(),this.renderAdvanced(),this.renderComposer())}}]),t}(a.Component),Ee=Object(l.b)((function(e){return{isLoaded:e.app.isLoaded,seasons:e.seasons}}),(function(e){return Object(y.b)({fetchCominovel:C},e)}))(ge),je=function(){return r.a.createElement(i.a,{locale:"en"},r.a.createElement(Ee,null))};Boolean("localhost"===window.location.hostname||"[::1]"===window.location.hostname||window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));var Ce=n(486),we=n(492),_e=n(248),ke=n(246),Se=n(495),Ae=n(247),Pe=n(137),Ie=function(e){return e.pipe(Object(_e.a)(v),Object(Ae.a)((function(e){return Object(ke.a)(Se.a.getJSON(window.Cominovel.endpoints.fetchComic.replace("<post_id>",e.payload))).pipe(Object(Pe.a)((function(e){return We.dispatch({payload:!0,type:"IS_LOADED"}),{payload:e,type:b}})))})))},De=Object(we.a)(Ie,(function(e){return e.pipe(Object(_e.a)(_),Object(Ae.a)((function(e){return Object(ke.a)(Se.a.getJSON("http://loveofboys.io/wp-json/cominovel/v1/comic/".concat(e.payload))).pipe(Object(Pe.a)((function(e){return{payload:e,type:g}})))})))}),(function(e){return e.pipe(Object(_e.a)(E),Object(Ae.a)((function(e){var t=e.taxonomy||"genre";return Object(ke.a)(Se.a.getJSON(window.Cominovel.endpoints.wpv2+t)).pipe(Object(Pe.a)((function(n){return function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"genre";return{keyword:arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",payload:e,taxonomy:t,type:j}}(n,t,e.keyword)})))})))}));function Te(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function xe(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?Te(n,!0).forEach((function(t){Object(F.a)(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):Te(n).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var Fe={isLoaded:null};function Ne(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}var Le={info:{ID:0,alternative_name:"",audult:"",author:"",badge:"",chapters:[],cmn_artist_terms:[],cmn_author_terms:[],cmn_country_terms:[],cmn_release_terms:[],cmn_status_terms:[],genre_terms:[],parent:0,post_content:"",post_excerpt:"",post_modified:"",post_name:"",post_parent:0,post_status:"",post_title:"",post_type:"",rating_system:"",season:"",short_description:""}};function Me(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function Ge(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?Me(n,!0).forEach((function(t){Object(F.a)(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):Me(n).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var Be=function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},t=arguments.length>1?arguments[1]:void 0;return t.type===j?Ge({},e,Object(F.a)({},t.taxonomy,t.payload)):e},Re={seasons:[]};var Ue=Object(y.c)({app:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:Fe,t=arguments.length>1?arguments[1]:void 0;switch(t.type){case"IS_LOADED":return xe({},e,{isLoaded:t.payload});default:return e}},cominovel:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:Le,t=arguments.length>1?arguments[1]:void 0;switch(t.type){case b:return function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?Ne(n,!0).forEach((function(t){Object(F.a)(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):Ne(n).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({},e,{info:t.payload});default:return e}},seasons:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:Re,t=arguments.length>1?arguments[1]:void 0;return t.type===g?t.payload:e},terms:Be}),Ke=Object(Ce.a)(),Ve=Object(y.d)(Ue,{},Object(y.a)(Ke));Ke.run(De);var We=Ve;c.a.render(r.a.createElement(l.a,{store:We},r.a.createElement(je,null)),document.getElementById("cominovel")),"serviceWorker"in navigator&&navigator.serviceWorker.ready.then((function(e){e.unregister()}))}},[[250,1,2]]]);
//# sourceMappingURL=main.9e30ae86.chunk.js.map