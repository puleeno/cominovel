import React, { Component } from 'react';
import { Tabs } from 'antd';
import Setup from './bootstrap/Setup';
import BasicInfo from './components/BasicInfo';
import Chapters from './components/Chapters';
import Composer from './components/Composer';

const { TabPane } = Tabs;

interface IState {}

interface IProps {}

class SlidingTabsDemo extends Component<IProps, IState> {
  componentWillMount() {
    Setup.bootstrap();
  }

  handleModeChange = (e:any) => {
    const mode = e.target.value;
    this.setState({ mode });
  };

  render() {
    return (
      <Tabs
        defaultActiveKey="1"
        tabPosition="left"
        type="card"
      >
          <TabPane
          tab="Basic Info"
          key="1"
          >
            <BasicInfo />
          </TabPane>

          <TabPane
            tab="Chapters"
            key="2"
          >
            <Chapters />
          </TabPane>

          <TabPane
            tab="Composer"
            key="3"
          >
            <Composer />
          </TabPane>
      </Tabs>
    );
  }
}

export default SlidingTabsDemo;
