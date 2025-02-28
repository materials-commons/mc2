import './bootstrap';
import chart from '@toast-ui/editor-plugin-chart';
import Editor from '@toast-ui/editor';
import '@toast-ui/editor/dist/toastui-editor.css';
import '@toast-ui/chart/dist/toastui-chart.css';

// const editor = new Editor({
//     el: document.querySelector('#editor'),
//     plugins: [chart],
//     height: '600px',
//     initialEditType: 'markdown',
//     placeholder: 'Write something cool!',
//     initialValue: '#### Hello World!',
// });

window.chart = chart;
window.Editor = Editor;