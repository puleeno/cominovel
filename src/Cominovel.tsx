import { Tabs } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { bindActionCreators } from "redux";
import { fetchCominovel } from "./actions";
import Setup from "./bootstrap/Setup";
import Advanced from "./components/Advanced";
import BasicInfo from "./components/BasicInfo";
import Chapters from "./components/Chapters";
import Composer from "./components/Composer";
import Seasons from "./components/Seasons";

const { TabPane } = Tabs;

interface IState {}

interface IProps {
}


class Cominovel extends Component<IProps, IState> {
  public UNSAFE_componentWillMount() {
    Setup.bootstrap();
  }

  public componentDidMount() {
    //
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
            tab="Advanced"
            key="4"
          >
            <Advanced />
          </TabPane>

          <TabPane
            tab="Composer"
            key="5"
          >
            <Composer />
          </TabPane>
      </Tabs>
    );
  }
}

export default Cominovel;
