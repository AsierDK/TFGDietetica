<?php
    require_once '../bbdd/bbdd.php';
    function AlimentosPorUsuario($idUsuario)
    {
        try
        {
            $conn=conexionbbdd();
            $stmt = $conn->prepare("SELECT * FROM Alimentos WHERE id_usuario = :id_usuario LIMIT 20");
            $stmt->bindParam(':id_usuario', $idUsuario);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
        return $resultado;
    }
    function AlergiaDeAlimento($id_alimentos,$idUsuario){
        try
        {
            $conn=conexionbbdd();
            $stmt = $conn->prepare("SELECT A.id_alergia,A.nombre_alergia FROM Alergias_Alimentos AL LEFT JOIN Alergias A ON AL.id_alergia = A.id_alergia WHERE AL.id_usuario = :id_usuario AND AL.id_alimento = :id_alimento");
            $stmt->bindParam(':id_usuario', $idUsuario);
            $stmt->bindParam(':id_alimentos', $id_alimentos);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch (PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
        return $resultado;
    }
    function obtenerAlimento($id_alimento)
    {
        try
        {
            $conn=conexionbbdd();
            $stmt = $conn->prepare("SELECT * FROM Alimentos WHERE id_alimentos = :id_alimento");
            $stmt->bindParam(':id_alimento', $id_alimento);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
        return $resultado[0];
    }
    function annadirAlimento($idUsuario,$params){
        $conn=conexionbbdd();
        try
        {
            $id_alimentos = obtenerUltimoIdAlimento();
            $id_alimentos = substr($id_alimentos, 0, 1) . str_pad(intval(substr($id_alimentos, 1)) + 1, 4, "0", STR_PAD_LEFT);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO Alimentos
                (id_alimentos, nombreAlimento, PC, e_100, prot_100, grasa_100, ags_100, agmi_100, agpi_100, col_100, hc_100, fibra_100, vit_c_100, vit_b6_100, vit_e_100, fe_100, na_100, ca_100, k_100, vit_d_100, id_usuario, fechaCreacion, fechaModificacion)
                VALUES 
                (:id_alimentos,:nombreAlimento,:PC,:e_100,:prot_100,:grasa_100,:ags_100,:agmi_100,:agpi_100,:col_100,:hc_100,:fibra_100,:vit_c_100,:vit_b6_100,:vit_e_100,:fe_100,:na_100,:ca_100,:k_100,:vit_d_100,:id_usuario,now(),now())");
            $stmt->bindParam(':id_alimentos', $id_alimentos);
            $stmt->bindParam(':nombreAlimento', $params['nombreAlimento']);
            $stmt->bindParam(':PC', $params['pc']);
            $stmt->bindParam(':e_100', $params['e_100']);
            $stmt->bindParam(':prot_100', $params['prot_100']);
            $stmt->bindParam(':grasa_100', $params['grasa_100']);
            $stmt->bindParam(':ags_100', $params['ags_100']);
            $stmt->bindParam(':agmi_100', $params['agmi_100']);
            $stmt->bindParam(':agpi_100', $params['agpi_100']);
            $stmt->bindParam(':col_100', $params['col_100']);
            $stmt->bindParam(':hc_100', $params['hc_100']);
            $stmt->bindParam(':fibra_100', $params['fibra_100']);
            $stmt->bindParam(':vit_c_100', $params['vit_c_100']);
            $stmt->bindParam(':vit_b6_100', $params['vit_b6_100']);
            $stmt->bindParam(':vit_e_100', $params['vit_e_100']);
            $stmt->bindParam(':fe_100', $params['fe_100']);
            $stmt->bindParam(':na_100', $params['na_100']);
            $stmt->bindParam(':ca_100', $params['ca_100']);
            $stmt->bindParam(':k_100', $params['k_100']);
            $stmt->bindParam(':vit_d_100', $params['vit_d_100']);
            $stmt->bindParam(':id_usuario', $idUsuario);
            $stmt -> execute();
            $conn -> commit();
        }
        catch(PDOException $e)
        {
            $conn -> rollBack();
            echo "Error: " . $e->getMessage();
        } finally {
            $conn=null;
        }
    }

    function obtenerUltimoIdAlimento()
    {
        try
        {
            $conn=conexionbbdd();
            $stmt = $conn->prepare("SELECT max(id_alimentos) as idAlimento FROM Alimentos");
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
        return $resultado[0]["idAlimento"];
    }

    function editarAlimento($idUsu, $params)
    {
        try
        {
            $conn=conexionbbdd();
            $stmt = $conn->prepare("UPDATE Alimentos SET nombreAlimento = :nombreAlimento, PC = :PC, e_100 = :e_100, prot_100 = :prot_100, grasa_100 = :grasa_100, ags_100 = :ags_100, agmi_100 = :agmi_100, agpi_100 = :agpi_100, col_100 = :col_100, hc_100 = :hc_100, fibra_100 = :fibra_100, vit_c_100 = :vit_c_100, vit_b6_100 = :vit_b6_100, vit_e_100 = :vit_e_100, fe_100 = :fe_100, na_100 = :na_100, ca_100 = :ca_100, k_100 = :k_100, vit_d_100 = :vit_d_100,fechaModificacion=now() WHERE id_alimentos = :id_alimentos AND id_usuario = :id_usuario");
            $stmt->bindParam(':id_alimentos', $params['id_alimento']);
            $stmt->bindParam(':nombreAlimento', $params['nombreAlimento']);
            $stmt->bindParam(':PC', $params['pc']);
            $stmt->bindParam(':e_100', $params['e_100']);
            $stmt->bindParam(':prot_100', $params['prot_100']);
            $stmt->bindParam(':grasa_100', $params['grasa_100']);
            $stmt->bindParam(':ags_100', $params['ags_100']);
            $stmt->bindParam(':agmi_100', $params['agmi_100']);
            $stmt->bindParam(':agpi_100', $params['agpi_100']);
            $stmt->bindParam(':col_100', $params['col_100']);
            $stmt->bindParam(':hc_100', $params['hc_100']);
            $stmt->bindParam(':fibra_100', $params['fibra_100']);
            $stmt->bindParam(':vit_c_100', $params['vit_c_100']);
            $stmt->bindParam(':vit_b6_100', $params['vit_b6_100']);
            $stmt->bindParam(':vit_e_100', $params['vit_e_100']);
            $stmt->bindParam(':fe_100', $params['fe_100']);
            $stmt->bindParam(':na_100', $params['na_100']);
            $stmt->bindParam(':ca_100', $params['ca_100']);
            $stmt->bindParam(':k_100', $params['k_100']);
            $stmt->bindParam(':vit_d_100', $params['vit_d_100']);
            $stmt->bindParam(':id_usuario', $idUsu);
            $stmt -> execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
    }
?>