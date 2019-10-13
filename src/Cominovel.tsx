import { Tabs } from "antd";
import React, { Component } from "react";
import Setup from "./bootstrap/Setup";
import BasicInfo from "./components/BasicInfo";
import Chapters from "./components/Chapters";
import Composer from "./components/Composer";
import Seasons from "./components/Seasons";

const { TabPane } = Tabs;

interface IState {}

interface IProps {}

class Cominovel extends Component<IProps, IState> {
  public componentWillMount() {
    Setup.bootstrap();
  }

  public handleModeChange = (e: any) => {
    const mode = e.target.value;
    this.setState({ mode });
  }

  public render() {
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
            tab="Seasons"
            key="3"
          >
            <Seasons />
          </TabPane>

          <TabPane
            tab="Composer"
            key="4"
          >
            <Composer />
          </TabPane>
      </Tabs>
    );
  }
}

export default Cominovel;
