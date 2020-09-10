import React from 'react';
import ReactDOM from 'react-dom';

/* Import Components */
import DrupalProjectStats from './components/DrupalProjectStats';
import NodeListOnly from "./components/NodeListOnly";
import NodeReadWrite from "./components/NodeReadWrite";

const Main = () => (
  // <DrupalProjectStats projectName="drupal" />
  // <NodeListOnly />
  <NodeReadWrite />
);

ReactDOM.render(<Main/>, document.getElementById('react-app'));