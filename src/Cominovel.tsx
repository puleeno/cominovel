import { Spin, Tabs } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { AnyAction, bindActionCreators, Dispatch } from "redux";
import { fetchCominovel } from "./actions";
import Setup from "./bootstrap/Setup";
import Advanced from "./components/Advanced";
import BasicInfo from "./components/BasicInfo";
import Chapters from "./components/Chapters";
import Composer from "./components/Composer";
import Seasons from "./components/Seasons";
import { IRootState } from "./reducers";

const { TabPane } = Tabs;
type IProps = ReturnType<typeof mapDispatchToProps> & ReturnType<typeof mapStateToProps>;
interface IState {
  seasonLoaded: boolean;
}

const initState: IState = {
  seasonLoaded: false,
};

class Cominovel extends Component<IProps, IState> {
  public state: IState = initState;

  public UNSAFE_componentWillMount() {
    Setup.bootstrap();
  }

  public componentDidMount() {
    if (typeof window.Cominovel.currentID === undefined) {
      return;
    }
    this.props.fetchCominovel(window.Cominovel.currentID);
  }

  public handleModeChange = (tab: any) => {
    if (tab === 'season') {
      this.setState({
        seasonLoaded: true,
      });
    }
  }

  public renderSeasons = () => {
    if (!this.state.seasonLoaded) {
      return;
    }
    return (<Seasons />);
  }

  public render() {
    if (this.props.isLoaded === null) {
      return(
        <Spin size="large" />
      );
    }
    return (
      <Tabs
        defaultActiveKey="1"
        tabPosition="left"
        type="card"
        onChange={this.handleModeChange}
      >
          <TabPane
          tab="Basic Info"
          key="basic"
          >
            <BasicInfo />
          </TabPane>

          <TabPane
            tab="Chapters"
            key="chapter"
          >
            <Chapters />
          </TabPane>

          <TabPane
            tab="Seasons"
            key="season"

          >
            {this.renderSeasons()}
          </TabPane>

          <TabPane
            tab="Advanced"
            key="advanced"
          >
            <Advanced />
          </TabPane>

          <TabPane
            tab="Composer"
            key="composer"
          >
            <Composer />
          </TabPane>
      </Tabs>
    );
  }
}

const mapStateToProps = (state: IRootState) => ({
  isLoaded: state.app.isLoaded,
  seasons: state.seasons,
});

const mapDispatchToProps = (dispatch: Dispatch<AnyAction>) =>
bindActionCreators({
  fetchCominovel,
}, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(Cominovel);
