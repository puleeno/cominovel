import { DatePicker} from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { IRootState } from "../../reducers";
import Form from "../antd/Form";

type IProps = ReturnType<typeof mapStateToProps>;

class Release extends Component<IProps> {
  public render() {
    return (
      <Form.Item label="Publish Date">
        <DatePicker
          placeholder="Select publish date"
          style={{width: 200}}
        />
      </Form.Item>
    );
  }
}

const mapStateToProps = (state: IRootState) => ({
  release: state.cominovel.info.cm_release_terms,
});

export default connect(mapStateToProps)(Release);
